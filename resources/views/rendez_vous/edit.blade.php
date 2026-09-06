@extends('layouts.app')

@section('title', 'Modifier le rendez-vous')

@section('content')

<style>
    .rdv-form-page {
        max-width: 1000px;
        margin: 0 auto;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #888;
        text-decoration: none;
        margin-bottom: 25px;
        transition: .3s;
    }

    .back-link:hover {
        color: #e50914;
    }

    .form-header {
        margin-bottom: 25px;
    }

    .form-header h1 {
        color: #fff;
        font-size: 30px;
        margin: 0 0 8px;
    }

    .form-header p {
        color: #777;
        margin: 0;
    }

    .form-card {
        background: #0d0d0d;
        border: 1px solid #252525;
        border-radius: 18px;
        padding: 30px;
    }

    .section-title {
        color: #e50914;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #222;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group.full {
        grid-column: 1 / -1;
    }

    label {
        color: #bbb;
        font-size: 13px;
        font-weight: 600;
    }

    label span {
        color: #e50914;
    }

    .input,
    .select,
    .textarea {
        width: 100%;
        box-sizing: border-box;
        padding: 13px 15px;
        background: #080808;
        color: #fff;
        border: 1px solid #292929;
        border-radius: 9px;
        outline: none;
        font-family: inherit;
    }

    .input:focus,
    .select:focus,
    .textarea:focus {
        border-color: #e50914;
    }

    .select option {
        background: #111;
        color: #fff;
    }

    .textarea {
        min-height: 130px;
        resize: vertical;
    }

    .error {
        color: #ff5963;
        font-size: 12px;
    }

    .current-info {
        background: #111;
        border: 1px solid #222;
        border-radius: 10px;
        padding: 15px;
        margin-bottom: 25px;
        color: #888;
        font-size: 13px;
    }

    .current-info strong {
        color: #fff;
    }

    .info-box {
        margin-top: 25px;
        padding: 15px;
        border-radius: 10px;
        background: rgba(229, 9, 20, .07);
        border: 1px solid rgba(229, 9, 20, .2);
        color: #999;
        font-size: 13px;
        line-height: 1.6;
    }

    .actions {
        display: flex;
        justify-content: flex-end;
        gap: 12px;
        margin-top: 30px;
        padding-top: 25px;
        border-top: 1px solid #222;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 13px 22px;
        border-radius: 9px;
        text-decoration: none;
        font-weight: 700;
        cursor: pointer;
        border: none;
        transition: .3s;
    }

    .btn-cancel {
        background: #181818;
        color: #aaa;
        border: 1px solid #292929;
    }

    .btn-cancel:hover {
        color: #fff;
    }

    .btn-submit {
        background: #e50914;
        color: #fff;
    }

    .btn-submit:hover {
        background: #ff1a25;
        transform: translateY(-2px);
    }

    @media (max-width: 700px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        .form-group.full {
            grid-column: auto;
        }

        .form-card {
            padding: 20px;
        }

        .actions {
            flex-direction: column;
        }

        .btn {
            width: 100%;
        }
    }
</style>

<div class="rdv-form-page">

    <a
        href="{{ route('rendez_vous.index') }}"
        class="back-link"
    >
        ← Retour aux rendez-vous
    </a>

    <div class="form-header">
        <h1>Modifier le rendez-vous</h1>

        <p>
            Modification du rendez-vous #{{ $rendezVous->id }}
        </p>
    </div>

    <div class="form-card">

        <div class="current-info">
            Rendez-vous actuel :
            <strong>
                {{ $rendezVous->date_rendez_vous->format('d/m/Y') }}
            </strong>
            à
            <strong>
                {{ \Carbon\Carbon::parse($rendezVous->heure)->format('H:i') }}
            </strong>
        </div>

        <div class="section-title">
            ✏️ Informations du rendez-vous
        </div>

        <form
            action="{{ route('rendez_vous.update', $rendezVous) }}"
            method="POST"
        >

            @csrf
            @method('PUT')

            <div class="form-grid">

                {{-- CLIENT --}}
                <div class="form-group">

                    <label for="client_id">
                        Client <span>*</span>
                    </label>

                    <select
                        name="client_id"
                        id="client_id"
                        class="select"
                        required
                    >

                        <option value="">
                            Sélectionner un client
                        </option>

                        @foreach($clients as $client)

                            <option
                                value="{{ $client->id }}"
                                {{ old('client_id', $rendezVous->client_id) == $client->id ? 'selected' : '' }}
                            >
                                {{ $client->nom }}
                                {{ $client->prenom }}
                                — {{ $client->telephone }}
                            </option>

                        @endforeach

                    </select>

                    @error('client_id')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                {{-- VEHICULE --}}
                <div class="form-group">

                    <label for="vehicule_id">
                        Véhicule <span>*</span>
                    </label>

                    <select
                        name="vehicule_id"
                        id="vehicule_id"
                        class="select"
                        required
                    >

                        <option value="">
                            Sélectionner un véhicule
                        </option>

                        @foreach($vehicules as $vehicule)

                            <option
                                value="{{ $vehicule->id }}"
                                {{ old('vehicule_id', $rendezVous->vehicule_id) == $vehicule->id ? 'selected' : '' }}
                            >
                                {{ $vehicule->marque->nom }}
                                {{ $vehicule->modele }}
                                — {{ number_format($vehicule->prix, 0, ',', ' ') }} Ar
                            </option>

                        @endforeach

                    </select>

                    @error('vehicule_id')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                {{-- DATE --}}
                <div class="form-group">

                    <label for="date_rendez_vous">
                        Date du rendez-vous <span>*</span>
                    </label>

                    <input
                        type="date"
                        name="date_rendez_vous"
                        id="date_rendez_vous"
                        class="input"
                        value="{{ old(
                            'date_rendez_vous',
                            $rendezVous->date_rendez_vous->format('Y-m-d')
                        ) }}"
                        required
                    >

                    @error('date_rendez_vous')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                {{-- HEURE --}}
                <div class="form-group">

                    <label for="heure">
                        Heure <span>*</span>
                    </label>

                    <input
                        type="time"
                        name="heure"
                        id="heure"
                        class="input"
                        value="{{ old(
                            'heure',
                            \Carbon\Carbon::parse($rendezVous->heure)->format('H:i')
                        ) }}"
                        required
                    >

                    @error('heure')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                {{-- STATUT --}}
                <div class="form-group">

                    <label for="statut">
                        Statut <span>*</span>
                    </label>

                    <select
                        name="statut"
                        id="statut"
                        class="select"
                        required
                    >

                        <option
                            value="En attente"
                            {{ old('statut', $rendezVous->statut) === 'En attente' ? 'selected' : '' }}
                        >
                            En attente
                        </option>

                        <option
                            value="Confirme"
                            {{ old('statut', $rendezVous->statut) === 'Confirme' ? 'selected' : '' }}
                        >
                            Confirmé
                        </option>

                        <option
                            value="Annul"
                            {{ old('statut', $rendezVous->statut) === 'Annul' ? 'selected' : '' }}
                        >
                            Annulé
                        </option>

                    </select>

                    @error('statut')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>


                {{-- MESSAGE --}}
                <div class="form-group full">

                    <label for="message">
                        Message / Demande particulière
                    </label>

                    <textarea
                        name="message"
                        id="message"
                        class="textarea"
                        placeholder="Message ou demande du client..."
                    >{{ old('message', $rendezVous->message) }}</textarea>

                    @error('message')
                        <div class="error">{{ $message }}</div>
                    @enderror

                </div>

            </div>


            <div class="info-box">
                💡 <strong>Information :</strong>
                Vous pouvez modifier le client, le véhicule,
                la date, l'heure, le statut ou le message du rendez-vous.
            </div>


            <div class="actions">

                <a
                    href="{{ route('rendez_vous.index') }}"
                    class="btn btn-cancel"
                >
                    Annuler
                </a>

                <button
                    type="submit"
                    class="btn btn-submit"
                >
                    ✓ Enregistrer les modifications
                </button>

            </div>

        </form>

    </div>

</div>

@endsection