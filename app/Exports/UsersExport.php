<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $users;
    function __construct($users)
    {
        $this->users = $users;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return collect($this->users);
    }



    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            "Name",
            "Email",
            "Phone",
            'User Type',
        ];
    }
}
