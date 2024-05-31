<?php

namespace App\Exports;

use App\Models\Participant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ParticipantsExport implements FromCollection, WithHeadings, WithMapping
{
    protected int $isActive;

    public function __construct($isActive)
    {
        $this->isActive = $isActive;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $query = Participant::with(['conference', 'user']);

        if ($this->isActive === 0) {
            $query->whereHas('conference', function ($q) {
                $q->where('isActive', true);
            });
        } 
        
        if ($this->isActive === 1) {
            $query->whereHas('conference', function ($q) {
                $q->where('isActive', false);
            });
        }

        return $query->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'User Email',
            'Conference Name',
            'Date',
            'Subject',
            'Link',
        ];
    }

    /**
     * @param mixed $participant
     * @return array
     */
    public function map($participant): array
    {
        return [
            $participant->id,
            $participant->user->email ?? 'N/A',
            $participant->conference->title ?? 'N/A',
            $participant->conference->start_date ? date('Y-m-d', strtotime($participant->conference->start_date)) : 'N/A',
            $participant->subject,
            $participant->link,
        ];
    }
}
