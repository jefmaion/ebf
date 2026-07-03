<?php

namespace App\Actions;

use App\Models\Register;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class PrintLabel
{

    public static function run(Register $register)
    {
        $connector = new WindowsPrintConnector("POS58");
        $printer = new Printer($connector);
        $printer->setTextSize(1, 2);
        $printer->text(str_repeat("-", 32) . "\n");
        $printer->text($register->childShortName() .  " (" . $register->childage . ' anos)' . "\n");
        $printer->text("Resp: " . $register->respShortName() . ' (' . $register->phone . ')' . "\n");
        $printer->text(str_repeat("-", 32) . "\n");
        $printer->cut();
        $printer->close();
    }
}
