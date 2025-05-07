<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Traits\LogsActivity;

class CompanyController extends Controller
{
    use LogsActivity;

    public function index(Request $request)
    {
        /**
         * Filtros: cidades, uf, status
         */

        
        $query = Company::with(['location']);

        // Filtro cidade
        if ($request->filled('cidade')) {

            if($request->cidade !== "Todas"){

                $query->whereHas('location', function($q) use ($request){
                    $q->where('cidade', 'like', '%' . $request->cidade . '%');
                });

            }

        }

         // Filtro uf
         if ($request->filled('uf')) {

            if($request->uf !== "Todos"){

                $query->whereHas('location', function($q) use ($request){
                    $q->where('uf', 'like', '%' . $request->uf . '%');
                });

            }

        }

        // Filtro Status
        if ($request->filled('status')){

            $query->whereIn('status', $request->status);

        }

        // Filtro Filtro data Company

        if($request->filled('filtro_data')) {
            $dias = match($request->filtro_data) {
                '7' => 7,
                '15' => 15,
                '30' => 30,
                '90' => 90,
                default => null,
            };

            if ($dias) {
                $query->where('created_at', '>=', now()->subDays($dias));
            }
        }

        $companies = $query->get();

        //dd($query->toRawSql());

        //$companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
                'cnpj' => 'required|string|unique:companies,cnpj',
                'razao_social' => 'required|string|max:255',
                'nome_fantasia' => 'required|string|max:255',
                'cep' => 'required|string|max:255',
                'logradouro' => 'required|string|max:255',
                'numero' => 'required|string|max:20',
                'complenento' => 'nullable|string|max:255',
                'bairro' => 'required|string|max:255',
                'pais' => 'required|string|max:255',
                'cidade' => 'required|string|max:255',
                'uf' => 'required|string|max:255',
                'nome_contato' => 'required|string|max:255',
                'email' => 'required|email',
                'telefone' => 'required|string|max:15',
                'whatsapp' => 'required|string|max:15',
                'logotipo' => 'required|file|mimes:jpg,jpeg,png|max:2048'
            ]);

           // dd($data);
        // Salvando imagem no banco e movendo arquivo para pasta.
        if($request->hasFile('logotipo') && $request->file('logotipo')->isValid()){
            $file = $request->file('logotipo');

            $extension = $file->getClientOriginalExtension();

            $fileName = md5($file->getClientOriginalName() . microtime()) . '.' . $extension;

            $file->move(public_path('documents/companies/images'), $fileName);

            $data['logotipo'] = $fileName;
        }

        $company = Company::create([
            'cnpj' => $data['cnpj'],
            'razao_social' => $data['razao_social'],
            'nome_fantasia' => $data['nome_fantasia'],
            'logotipo' => $data['logotipo']
        ]);

        $company->contacts()->create([
            'telefone' => $data['telefone'],
            'email' => $data['email'],
            'nome_contato' => $data['nome_contato'],
            'whatsapp' => $data['whatsapp']
        ]);

        $company->location()->create([
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complenento' => $data['complenento'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'uf' => $data['uf'],
            //'logradouro' => $data['logradouro'],
            'cep' => $data['cep'],
            'pais' => $data['pais']
        ]);


        // Salvando Log de criação
        $this->logAction('create', 'companies', $company->id, 'Empresa cadastrado com sucesso.');

        return redirect()->route('companies.index')->with('success', 'Empresa cadastrada com sucesso!');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        //dd($request->all());

        $data = $request->validate([
            'cnpj' => 'required|string|unique:companies,cnpj,'. $company->id,
            'razao_social' => 'required|string|max:255',
            'nome_fantasia' => 'required|string|max:255',
            'cep' => 'required|string|max:255',
            'logradouro' => 'required|string|max:255',
            'numero' => 'required|string|max:20',
            'complenento' => 'nullable|string|max:255',
            'bairro' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'cidade' => 'required|string|max:255',
            'uf' => 'required|string|max:255',
            'nome_contato' => 'required|string|max:255',
            'email' => 'required|email',
            'telefone' => 'required|string|max:15',
            'whatsapp' => 'required|string|max:15',
            'logotipo' => 'file|mimes:jpg,jpeg,png|max:2048'
        ]);

        //dd($data);

        $logotipo_atual = $company->logotipo;

        // Salvando imagem no banco e movendo arquivo para pasta.
        if($request->hasFile('logotipo') && $request->file('logotipo')->isValid()){
            $file = $request->file('logotipo');

            $extension = $file->getClientOriginalExtension();

            $fileName = md5($file->getClientOriginalName() . microtime()) . '.' . $extension;

            $file->move(public_path('documents/companies/images'), $fileName);

            $data['logotipo'] = $fileName;

            if($logotipo_atual){
                unlink(public_path('documents/companies/images/'. $logotipo_atual));
            }
        } else {
            $data['logotipo'] = $logotipo_atual;
        }


        $company->update([
            'cnpj' => $data['cnpj'],
            'razao_social' => $data['razao_social'],
            'nome_fantasia' => $data['nome_fantasia'],
            'logotipo' => $data['logotipo'],
            'status' => ($request->input('status') === 'on') ? 'ativo' : 'inativo'
        ]);

        $company->contacts()->update([
            'telefone' => $data['telefone'],
            'email' => $data['email'],
            'nome_contato' => $data['nome_contato'],
            'whatsapp' => $data['whatsapp']
        ]);

        $company->location()->update([
            'logradouro' => $data['logradouro'],
            'numero' => $data['numero'],
            'complenento' => $data['complenento'],
            'bairro' => $data['bairro'],
            'cidade' => $data['cidade'],
            'uf' => $data['uf'],
            //'logradouro' => $data['logradouro'],
            'cep' => $data['cep'],
            'pais' => $data['pais']
        ]);



        // Salvando Log de criação
        $this->logAction('update', 'companies', $company->id, 'Empresa atualizada com sucesso.');

        return redirect()->route('companies.index')->with('success', 'Empresa atualizada com sucesso!');
    }

    public function destroy(Company $company)
    {       

        // Logotipo atual
        $logotipo_atual = $company->logotipo;
        
        // Deletar a Empresa
        $company->delete();
        
      
        // Após delete no banco, deletar o arquivo do logotipo 0f0e5dce0fd8ebe899215d35d9fbb13b.png

        if($logotipo_atual) {
            $caminhoArquivo = public_path('documents/companies/images/'. $logotipo_atual);
            if(file_exists($caminhoArquivo)){
                unlink($caminhoArquivo);
            }
        }

        // Salvando Log de criação
        $this->logAction('delete', 'companies', $company->id, 'Empresa excluído.');

        return redirect()->route('companies.index')->with('success', 'Empresa excluída com sucesso!');
    }


    public function updateStatus(Request $request, $companyId)
    {
        $company = Company::findOrFail($companyId);

        // Atualiza o status com base no valor do switch
        $company->status = $request->input('status') === 'on' ? 'ativo' : 'inativo';
        $company->save();

        return redirect()->back()->with('success', 'Status atualizado com sucesso!');
    }


}
