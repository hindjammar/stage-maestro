<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Color;
use App\Models\Component;
use App\Models\Reference;
use App\Models\Product;
use App\Models\Vehicule;
use PHPExcel;
use PHPExcel_IOFactory;

class ExcelController extends Controller
{
    // Affiche une vue contenant un tableau Excel
    public function afficherVue()
    {   
        // $couleurs = Color::all();
        // $references= Reference::all();
        // $vehicules=Vehicule::all();
        // $components = Component::all();
        $vehicules = Vehicule::with(['color','reference'])->get();
        $vehicules = Vehicule::with('reference')->get(); // Charger la relation 'reference'

        $references = Reference::with('vehicules','components','color')->get(); // Charger la relation "components"

        return view('creator.tableau',compact('vehicules', 'references'));
    }


    public function afficherProduct()
    {   
        $couleurs = Color::all();
        $references= Reference::all();
        $vehicules=Vehicule::all();
        $products = Product::all();

        return view('admin.products',compact('couleurs','references','vehicules','products'));
    }

    // Crée un fichier Excel avec des utilisateurs
    public function creerExcel()
    {
        $users = User::all();

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Nom');
        $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Email');

        $row = 2;
        foreach ($users as $user) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $user->name);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $user->email);
            $row++;
        }

        $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $writer->save(storage_path('app/users.xlsx'));

        return redirect()->route('afficher-vue');
    }

    // Exporte des données vers un fichier Excel
    public function exporterExcel()
    {
        $products = Product::all();

        $excel = new PHPExcel();

        $excel->getProperties()->setTitle('Products');

        $sheet = $excel->setActiveSheetIndex(0);

        $sheet->setCellValue('A1', 'Marque');
        $sheet->setCellValue('B1', 'Modèle');
        $sheet->setCellValue('C1', 'Couleur');
        $sheet->setCellValue('D1', 'Référence');
        $sheet->setCellValue('E1', 'Année');
        $sheet->setCellValue('F1', 'Composants');
        $sheet->setCellValue('G1', 'Quantité d\'articles');

        $row = 7;

        foreach ($products as $product) {
            $sheet->setCellValue('A' . $row, $product->marque);
            $sheet->setCellValue('B' . $row, $product->modele);
            $sheet->setCellValue('C' . $row, $product->couleur);
            $sheet->setCellValue('D' . $row, $product->reference);
            $sheet->setCellValue('E' . $row, $product->annee);
            $sheet->setCellValue('F' . $row, $product->composants);
            $sheet->setCellValue('G' . $row, $product->qtt_article);

            $row++;
        }

        $writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $writer->save(storage_path('app/products.xlsx'));

        return response()->download(storage_path('app/products.xlsx'))->deleteFileAfterSend(true);
    }


    
    
    

    // Importe des données à partir d'un fichier Excel
    public function importerExcel(Request $request)
    {
        if ($request->hasFile('fichier_excel')) {
            $file = $request->file('fichier_excel');

            $objPHPExcel = PHPExcel_IOFactory::load($file);
            $worksheet = $objPHPExcel->getActiveSheet();

            $data = [];
            foreach ($worksheet->getRowIterator() as $row) {
                $rowData = [];
                foreach ($row->getCellIterator() as $cell) {
                    $rowData[] = $cell->getValue();
                }
                $data[] = $rowData;
            }

            // Traitez les données comme nécessaire
            // Par exemple, enregistrez-les dans la base de données

            return redirect()->route('afficher-vue')->with('success', 'Données importées avec succès.');
        }

        return redirect()->route('afficher-vue')->with('error', 'Aucun fichier sélectionné.');
    }
}
