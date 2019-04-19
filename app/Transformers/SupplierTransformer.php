<?php
namespace App\Transformers;
use League\Fractal\TransformerAbstract;
use App\Supplier;

class SupplierTransformer extends TransformerAbstract
{
    /**
     * Transform Barang.
     *
     * @param Service $service
     */
    public function transform(Supplier $supplier)
    {
        return [
            'id_supplier' => $supplier->id_supplier,
            'nama_supplier' => $supplier->nama_supplier,
            'noTelp_supplier' => $supplier->noTelp_supplier,
            'alamat_supplier' => $supplier->alamat_supplier,
            'nama_sales' => $supplier->nama_sales,
            'noTelp_sales' => $supplier->noTelp_sales,
        ];
    }
    
}