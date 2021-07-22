<?php

namespace App\Http\Controllers;

use App\RomanToInteger;
use Illuminate\Http\Request;

class RomanToIntegerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Getting the requested roman number and convert to UpperCase by default
        $toBeConverted = strtoupper($request->value);
        $preserveValue = $toBeConverted;
        $response = 0;
        $colect = collect([]);

        //Defining my roman value status case
        $values = array('I', 'IV', 'V', 'IX', 'X', 'XL', 'L', 'XC', 'C', 'CD', 'D', 'M', 'CM');

        //giving correspondent int value to each Roman number
        $valueAttribuition = array(
            $values[8] => 100, $values[7] => 90, $values[6] => 50, $values[5] => 40,
            $values[11] => 1000, $values[12] => 900, $values[10] => 500, $values[9] => 400,
            $values[4] => 10, $values[3] => 9, $values[2] => 5, $values[1] => 4,
            $values[0] => 1
        );

        //Validating the values requested for conversion
        if ($this->validateRomanValues($preserveValue, $values, 1)) {

            foreach ($valueAttribuition as $key => $a) {
                while (strpos($toBeConverted, $key) === 0) {
                    $response += $a;
                    $toBeConverted = substr($toBeConverted, strlen($key));
                }
            }

            $colect->push([
                'Valor inteiro' => $response
            ]);
        } else {
            //handling error of not roman values requested
            $colect = $this->validateRomanValues($preserveValue, $values, 0);
        }


        return response()->json(array(
            'Valor romano' => $preserveValue,
            'Resultado' => $colect

        ), 200);
    }

    //Validation method
    function validateRomanValues($value, $arry, $type)
    {

        $lenght = strlen($value);
        $result = true;
        $colectNotRoman = "";

        if ($lenght > 0) {
            for ($i = 0; $i < $lenght; $i++) {

                if (in_array($value[$i], $arry)) {
                    //
                } else {
                    $result = false;
                    $colectNotRoman = $colectNotRoman . " " . $value[$i];
                }
            }
            $colectNotRoman = str_replace(' ', ' ', $colectNotRoman);

            if ($type == 0) {
                $result = "Ocorreu um erro, o(s) valore(s) [" . $colectNotRoman . "] não é /são numero(s) romano(s)";
            }
        } else {

            $result = false;
            if ($type == 0) {
                $result = "Parametro vázio, por favor informe o valor romano!";
            }
        }


        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RomanToInteger  $romanToInteger
     * @return \Illuminate\Http\Response
     */
    public function show(RomanToInteger $romanToInteger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RomanToInteger  $romanToInteger
     * @return \Illuminate\Http\Response
     */
    public function edit(RomanToInteger $romanToInteger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RomanToInteger  $romanToInteger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RomanToInteger $romanToInteger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RomanToInteger  $romanToInteger
     * @return \Illuminate\Http\Response
     */
    public function destroy(RomanToInteger $romanToInteger)
    {
        //
    }
}
