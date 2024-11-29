<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BookExport implements FromArray, ShouldAutoSize, WithHeadings
{
    public function headings(): array
    {
        return [
            '#',
            'Judul',
            'Penulis',
            'Tahun Terbit',
            'Penerbit',
            'Kota',
            'Rak',
        ];
    }

    public function array(): array
    {
        $data = Book::all();
        $filt = [];
        for ($i = 0; $i < $data->count(); $i++) {
            $filt[$i]['no'] = $i + 1;
            $filt[$i]['title'] = $data[$i]->title;
            $filt[$i]['author'] = $data[$i]->author;
            $filt[$i]['year'] = $data[$i]->year;
            $filt[$i]['publisher'] = $data[$i]->publisher;
            $filt[$i]['city'] = $data[$i]->city;
            $filt[$i]['bookshelf'] = $data[$i]->bookshelf->name;
        }
        return $filt;
    }
}