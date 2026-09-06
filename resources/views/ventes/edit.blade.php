```blade
@extends('layouts.app')

@section('title', 'Modifier une vente')

@section('content')

<style>
    .sales-edit {
        max-width: 1000px;
        margin: 0 auto;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-header h1 {
        color: #fff;
        font-size: 30px;
        font-weight: 800;
        margin: 0 0 7px;
    }

    .page-header p {
        color: #777;
        margin: 0;
        font-size: 14px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 18px;
        border-radius: 10px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 13px;
        font-weight: 700;
        transition: .2s;
    }

    .btn-primary {
        background: #e50914;
        color: #fff;
        box-shadow: 0 8px 20px rgba(229, 9, 20, .15);
    }

    .btn-primary:hover {
        background: #c70711;
        transform: translateY(-1px);
    }

    .btn-secondary {
        background: #1c1c1c;
        color: #aaa;
        border: 1px solid #292929;
    }

    .btn-secondary:hover {
        background: #292929;
        color: #fff;
    }

    .form-card {
        background: #101010;
        border: 1px solid #252525;
        border-radius: 16px;
        overflow: hidden;
    }

    .form-header {
        padding: 20px 25px;
        border-bottom: 1px solid #252525;
    }

    .form-header h2 {
        color: #fff;
        font-size: 18px;
        margin: 0;
    }

    .form-body {
        padding: 25px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label {
        color: #aaa;
        font-size: 12px;
        font-weight: 700;
    }

    .form-group label span {
        color: #e50914;
    }

    .form-group input,
    .form-group select {
        width: 100%;
        box-sizing: border-box;
        background: #080808;
        border: 1px solid #292929;
        border-radius: 9px;
        color: #fff;
        padding: 13px;
        outline: none;
        font-size: 13px;
    }

    .form-group input:focus,
    .form-group select:focus {
        border-color: #e50914;
        box-shadow: 0 0 0 3px rgba(229, 9, 20, .08);
    }

    .form-group select option {
        background: #101010;
        color: #fff;
    }

    .error {
        color: #ff5964;
        font-size: 11px;
    }

    .alert-error {
        padding: 14px 17px;
        border-radius: 10px;
        margin-bottom: 20px;
        background: rgba(229, 9, 20, .08);
        border: 1px solid rgba(229, 9, 20, .25);
        color: #ff5964;
        font-size: 13px;
    }

    .current-info {
        background: #080808;
        border: 1px solid #252525;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 25px;
    }

    .current-info-title {
        color: #777;
        font-size: 10px;
        text-transform: uppercase;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .current-info-value {
        color: #fff;
        font-size: 14px;
        font-weight: 700;
    }

    .form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid #252525;
    }

    @media (max-width: 700px) {

        .form-grid {
            grid-template-columns: 1fr;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }
    }
</style>


<div class="sales-edit">

    {{-- HEADER --}}
    <div class="page-header">

        <div>
            <h1>Modifier la vente</h1>

            <p>
                Modifier les informations de cette vente.
            </p>
        </div>

        <a
            href="{{ route('ventes.index') }}"
            class="btn btn-secondary"
        >
            ← Retour
        </a>

    </div>


    {{-- ERREURS --}}
    @if ($errors->any())

        <div class="alert-error">

            <strong>
                Veuillez corriger les erreurs :
            </strong>

            <ul style="margin: 8px 0 0 20px;">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- FORMULAIRE --}}
    <div class="form-card">

        <div class="form-header">

            <h2>
                Informations de la vente
            </h2>

        </div>


        <div class="form-body">


            {{-- INFORMATIONS ACTUELLES --}}
            @if($vente->vehicule)

                <div class="current-info">

                    <div class="current-info-title">
                        Véhicule actuellement associé
                    </div>

                    <div class="current-info-value">

                        {{ $vente->vehicule->marque->nom ?? '' }}

                        {{ $vente->vehicule->modele }}

                        @if($vente->vehicule->immatriculation)

                            - {{ $vente->vehicule->immatriculation }}

                        @endif

                    </div>

                </div>

            @endif


            <form
                action="{{ route('ventes.update', $vente) }}"
                method="POST"
            >

                @csrf

                @method('PUT')


                <div class="form-grid">


                    {{-- VEHICULE --}}
                    <div class="form-group">

                        <label for="vehicule_id">

                            Véhicule

                            <span>*</span>

                        </label>


                        <select
                            name="vehicule_id"
                            id="vehicule_id"
                            required
                        >

                            <option value="">
                                -- Sélectionner un véhicule --
                            </option>


                            @foreach($vehicules as $vehicule)

                                <option
                                    value="{{ $vehicule->id }}"
                                    data-prix="{{ $vehicule->prix }}"
                                    {{ old(
                                        'vehicule_id',
                                        $vente->vehicule_id
                                    ) == $vehicule->id
                                        ? 'selected'
                                        : ''
                                    }}
                                >

                                    {{ $vehicule->marque->nom ?? '' }}

                                    {{ $vehicule->modele }}

                                    @if($vehicule->immatriculation)

                                        -
                                        {{ $vehicule->immatriculation }}

                                    @endif

                                </option>

                            @endforeach

                        </select>


                        @error('vehicule_id')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- CLIENT --}}
                    <div class="form-group">

                        <label for="client_id">

                            Client

                            <span>*</span>

                        </label>


                        <select
                            name="client_id"
                            id="client_id"
                            required
                        >

                            <option value="">
                                -- Sélectionner un client --
                            </option>


                            @foreach($clients as $client)

                                <option
                                    value="{{ $client->id }}"
                                    {{ old(
                                        'client_id',
                                        $vente->client_id
                                    ) == $client->id
                                        ? 'selected'
                                        : ''
                                    }}
                                >

                                    {{ $client->prenom }}

                                    {{ $client->nom }}

                                    @if($client->email)

                                        -
                                        {{ $client->email }}

                                    @endif

                                </option>

                            @endforeach

                        </select>


                        @error('client_id')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- PRIX --}}
                    <div class="form-group">

                        <label for="prix_vente">

                            Prix de vente

                            <span>*</span>

                        </label>


                        <input
                            type="number"
                            name="prix_vente"
                            id="prix_vente"
                            value="{{ old(
                                'prix_vente',
                                $vente->prix_vente
                            ) }}"
                            min="0"
                            step="0.01"
                            required
                        >


                        @error('prix_vente')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- DATE --}}
                    <div class="form-group">

                        <label for="date_vente">

                            Date de vente

                            <span>*</span>

                        </label>


                        <input
                            type="date"
                            name="date_vente"
                            id="date_vente"
                            value="{{ old(
                                'date_vente',
                                $vente->date_vente
                                    ? $vente->date_vente->format('Y-m-d')
                                    : ''
                            ) }}"
                            required
                        >


                        @error('date_vente')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- MODE DE PAIEMENT --}}
                    <div class="form-group">

                        <label for="mode_paiement">

                            Mode de paiement

                            <span>*</span>

                        </label>


                        <select
                            name="mode_paiement"
                            id="mode_paiement"
                            required
                        >

                            <option value="">
                                -- Sélectionner --
                            </option>


                            <option
                                value="Especes"
                                {{ old(
                                    'mode_paiement',
                                    $vente->mode_paiement
                                ) === 'Especes'
                                    ? 'selected'
                                    : ''
                                }}
                            >
                                Espèces
                            </option>


                            <option
                                value="Carte"
                                {{ old(
                                    'mode_paiement',
                                    $vente->mode_paiement
                                ) === 'Carte'
                                    ? 'selected'
                                    : ''
                                }}
                            >
                                Carte
                            </option>


                            <option
                                value="Virement"
                                {{ old(
                                    'mode_paiement',
                                    $vente->mode_paiement
                                ) === 'Virement'
                                    ? 'selected'
                                    : ''
                                }}
                            >
                                Virement
                            </option>


                            <option
                                value="Credit"
                                {{ old(
                                    'mode_paiement',
                                    $vente->mode_paiement
                                ) === 'Credit'
                                    ? 'selected'
                                    : ''
                                }}
                            >
                                Crédit
                            </option>

                        </select>


                        @error('mode_paiement')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- STATUT --}}
                    <div class="form-group">

                        <label for="statut">

                            Statut

                            <span>*</span>

                        </label>


                        <select
                            name="statut"
                            id="statut"
                            required
                        >

                            <option value="">
                                -- Sélectionner --
                            </option>


                            <option
                                value="Confirmee"
                                {{ old(
                                    'statut',
                                    $vente->statut
                                ) === 'Confirmee'
                                    ? 'selected'
                                    : ''
                                }}
                            >
                                Confirmée
                            </option>


                            <option
                                value="En attente"
                                {{ old(
                                    'statut',
                                    $vente->statut
                                ) === 'En attente'
                                    ? 'selected'
                                    : ''
                                }}
                            >
                                En attente
                            </option>


                            <option
                                value="Annulee"
                                {{ old(
                                    'statut',
                                    $vente->statut
                                ) === 'Annulee'
                                    ? 'selected'
                                    : ''
                                }}
                            >
                                Annulée
                            </option>

                        </select>


                        @error('statut')

                            <div class="error">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                {{-- BOUTONS --}}
                <div class="form-footer">

                    <a
                        href="{{ route('ventes.index') }}"
                        class="btn btn-secondary"
                    >
                        Annuler
                    </a>


                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        ✓ Enregistrer les modifications
                    </button>

                </div>


            </form>

        </div>

    </div>

</div>


{{-- PRIX AUTOMATIQUE --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const vehicule =
        document.getElementById('vehicule_id');

    const prix =
        document.getElementById('prix_vente');


    vehicule.addEventListener('change', function () {

        const option =
            this.options[this.selectedIndex];

        const prixVehicule =
            option.getAttribute('data-prix');


        if (prixVehicule) {

            prix.value = prixVehicule;

        }

    });

});

</script>

@endsection
```
