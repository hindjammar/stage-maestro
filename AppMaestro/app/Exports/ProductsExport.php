<?php
  
namespace App\Exports;
  
use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
  
class ProductsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::all();
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["Marque", "Modele", "Couleur","Reference","Annee","Composants","Qtt_article"];
    }
}