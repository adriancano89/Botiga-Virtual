<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\ProductoPedido;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class PDFController extends Controller
{
    public function imprimirFactura(string $id) {
        $pedido = Pedido::with('usuario')->find($id);
        $productosPedidos = ProductoPedido::with('producto')->where('pedidos_id', $id)->get();
        $data = [
            "pedido" => $pedido,
            "productosPedido" => $productosPedidos,
        ];
        $pdf = PDF::loadView('pedidos.factura', $data);
        return $pdf->stream('factura.pdf');
    }
}
