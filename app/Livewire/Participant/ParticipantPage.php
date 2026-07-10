<?php

namespace App\Livewire\Participant;

use App\Actions\PrintLabel;
use App\Mail\WelcomeRegister;
use App\Models\Register;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Shuchkin\SimpleXLSXGen;

class ParticipantPage extends Component
{

    use WithPagination;

    public ?Register $register = null;

    public $search = '';


    #[On('checkin-changed')]
    public function refresh() {
        $this->dispatch('$refresh');
    }

    #[On('delete-checkin')]
    public function confirmDelete(Register $register) {
        $this->register = $register;
        $this->dispatch('show-modal', modal:'modal-delete');
    }

    #[On('delete-item')]
    public function delete() {
        $this->register->delete();
        $this->register = null;
        $this->dispatch('hide-modal', modal:'modal-delete');
        $this->refresh();
    }

    public function sendEmail(Register $register) {
        Mail::to($register->email)->send(
            new WelcomeRegister(
                $register->name,
                $register->childname,
                $register->hash // O ID que a sua impressora MPT vai ler depois!
            )
        );
    }

    public function print(Register $register) {
        // PrintLabel::run($register);

        $data = PrintLabel::raw($register);
        $this->dispatch('print-cupom', data: $data);

    }

    public function printAll() {
        $data = null;

        foreach(Register::orderBy('childname', 'asc')->get() as $register) {
            $data .= PrintLabel::raw($register);
        }



        $this->dispatch('print-cupom', data: $data);
    }

    public function updatingSearch()
    {
        $this->resetPage(); // Força o Livewire a voltar para a página 1
    }

    public function export() {
        $data = Register::select([
            'registers.created_at as data_inscrição',
             'childname as participante',
             'childage as idade',
             'childgender as sexo',
             'childbirthdate as data_de_nascimento',
             'registers.name as responsavel',
             'phone as telefone_responsavel',
             'registers.email as email_responsavel',
             'childchurch as igreja',
             'food_restriction as restrição_alimentar',
             'checkin_date as hora_checkin',
             'users.name as checkin_feito_por',
             'checkout_date as hora_checkout',
            'b.name as checkout_feito_por'])
        ->leftJoin('users', 'users.id', '=', 'registers.user_id_checkin')
        ->leftJoin('users as b', 'b.id', '=', 'registers.user_id_checkout')
        ->orderBy('registers.childname', 'asc')
        ->get()->toArray();

        if(empty($data)) return;

        $headers = array_keys($data[0]);

        // 3. Monte a matriz final: o cabeçalho é a primeira linha, seguido pelos dados
        $data = array_merge([$headers], $data);


        $file = SimpleXLSXGen::fromArray( $data );

        $fileName = 'usuarios_exportados.xlsx';
        return response()->streamDownload(function () use ($file) {
            echo (string) $file;
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);




    }

    public function render()
    {

    //     dd(Register::select('childage', DB::raw('count(*) as total'))
    // ->groupBy('childage')
    // ->orderBy('childage', 'asc')
    // ->get());

        return view('livewire.participant.participant-page', [
            'children' => Register::whereLike('childname', '%' . $this->search . '%')->orWhereLike('hash', '%' . $this->search . '%')->orderBy('id', 'desc')->paginate(10),

            'box' => [
                'Participantes' => Register::count(),
                'Presentes' => Register::whereNotNull('checkin_date')->count(),
                'Ausentes' => Register::whereNull('checkin_date')->count(),
                'Meninos' => Register::where('childgender', 'M')->count(),
                'Meninas' => Register::where('childgender', 'F')->count(),
            ]
        ]);
    }
}
