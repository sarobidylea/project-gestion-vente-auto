@extends('layouts.app')

@section('title', 'Facture ' . $vente->numero_facture)

@section('content')

<style>
    .invoice-page {
        max-width: 950px;
        margin: 0 auto;
    }

    .invoice-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .back-link {
        color: #999;
        text-decoration: none;
        font-size: 14px;
    }

    .back-link:hover {
        color: #e50914;
    }

    .invoice-buttons {
        display: flex;
        gap: 10px;
    }

    .btn {
        padding: 11px 18px;
        border-radius: 9px;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 13px;
        font-weight: 700;
    }

    .btn-primary {
        background: #e50914;
        color: white;
    }

    .btn-secondary {
        background: #191919;
        color: #aaa;
        border: 1px solid #292929;
    }

    .invoice {
        background: #fff;
        color: #111;
        border-radius: 14px;
        padding: 50px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, .35);
    }

    /* HEADER */

    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 30px;
        padding-bottom: 30px;
        border-bottom: 3px solid #e50914;
    }

    .company-name {
        font-size: 30px;
        font-weight: 900;
        letter-spacing: 2px;
        color: #111;
        margin: 0;
    }

    .company-name span {
        color: #e50914;
    }

    .company-info {
        margin-top: 10px;
        color: #666;
        font-size: 13px;
        line-height: 1.7;
    }

    .invoice-title {
        text-align: right;
    }

    .invoice-title h1 {
        margin: 0;
        font-size: 32px;
        color: #111;
        letter-spacing: 2px;
    }

    .invoice-number {
        margin-top: 8px;
        color: #e50914;
        font-weight: 800;
        font-size: 15px;
    }

    .invoice-date {
        margin-top: 5px;
        color: #777;
        font-size: 13px;
    }

    /* CLIENT */

    .invoice-info {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin: 35px 0;
    }

    .info-box {
        background: #f7f7f7;
        border-radius: 10px;
        padding: 20px;
    }

    .info-box h3 {
        margin: 0 0 12px;
        color: #e50914;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .info-box strong {
        display: block;
        font-size: 16px;
        margin-bottom: 7px;
    }

    .info-box p {
        margin: 4px 0;
        color: #666;
        font-size: 13px;
    }

    /* TABLE */

    .invoice-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .invoice-table th {
        background: #111;
        color: white;
        text-align: left;
        padding: 14px;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .5px;
    }

    .invoice-table td {
        padding: 18px 14px;
        border-bottom: 1px solid #ddd;
        font-size: 14px;
    }

    .vehicle-name {
        font-weight: 800;
        font-size: 15px;
    }

    .vehicle-details {
        color: #777;
        font-size: 12px;
        margin-top: 5px;
    }

    .text-right {
        text-align: right !important;
    }

    /* TOTAL */

    .total-section {
        display: flex;
        justify-content: flex-end;
        margin-top: 30px;
    }

    .total-box {
        width: 330px;
    }

    .total-row {
        display: flex;
        justify-content: space-between;
        padding: 12px 0;
        border-bottom: 1px solid #ddd;
        color: #555;
        font-size: 14px;
    }

    .total-final {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        padding: 18px;
        background: #111;
        color: white;
        border-radius: 8px;
    }

    .total-final span {
        font-size: 13px;
        text-transform: uppercase;
    }

    .total-final strong {
        color: #e50914;
        font-size: 20px;
    }

    /* PAYMENT */

    .payment {
        margin-top: 35px;
        padding: 20px;
        background: #f7f7f7;
        border-left: 4px solid #e50914;
    }

    .payment strong {
        font-size: 13px;
    }

    .payment span {
        color: #555;
        margin-left: 8px;
        font-size: 13px;
    }

    /* FOOTER */

    .invoice-footer {
        margin-top: 50px;
        padding-top: 20px;
        border-top: 1px solid #ddd;
        text-align: center;
        color: #888;
        font-size: 12px;
        line-height: 1.7;
    }

    .thank-you {
        color: #111;
        font-weight: 700;
        margin-bottom: 5px;
    }

    /* PRINT */

    @media print {

        body {
            background: white !important;
        }

        .sidebar,
        .top-header,
        .invoice-actions {
            display: none !important;
        }

        .invoice-page {
            max-width: 100%;
            margin: 0;
        }

        .invoice {
            box-shadow: none;
            border-radius: 0;
            padding: 20px;
        }
    }

    @media (max-width: 700px) {

        .invoice {
            padding: 25px;
        }

        .invoice-header {
            flex-direction: column;
        }

        .invoice-title {
            text-align: left;
        }

        .invoice-info {
            grid-template-columns: 1fr;
        }

        .total-section {
            justify-content: stretch;
        }

        .total-box {
            width: 100%;
        }

        .invoice-actions {
            flex-direction: column;
            align-items: stretch;
            gap: 15px;
        }

        .invoice-buttons {
            flex-direction: column;
        }
    }
</style>


<div class="invoice-page">

    {{-- ACTIONS --}}
    <div class="invoice-actions">

        <a href="{{ route('ventes.show', $vente) }}" class="back-link">
            ← Retour aux détails de la vente
        </a>

        <div class="invoice-buttons">

            <a
                href="{{ route('ventes.index') }}"
                class="btn btn-secondary"
            >
                Retour
            </a>

            <button
                type="button"
                onclick="window.print()"
                class="btn btn-primary"
            >
                🖨️ Imprimer la facture
            </button>

        </div>

    </div>


    {{-- FACTURE --}}
    <div class="invoice">

        {{-- HEADER --}}
        <div class="invoice-header">

            <div>

                <h2 class="company-name">
                    LUXORA <span>MOTORS</span>
                </h2>

                <div class="company-info">
                    Vente & Importation Automobile<br>
                    Fianarantsoa, Madagascar<br>
                    Téléphone : +261 XX XX XXX XX<br>
                    Email : contact@luxoramotors.com
                </div>

            </div>


            <div class="invoice-title">

                <h1>FACTURE</h1>

                <div class="invoice-number">
                    {{ $vente->numero_facture }}
                </div>

                <div class="invoice-date">
                    Date :
                    {{ $vente->date_vente->format('d/m/Y') }}
                </div>

            </div>

        </div>


        {{-- CLIENT / VENTE --}}
        <div class="invoice-info">

            <div class="info-box">

                <h3>Facturé à</h3>

                <strong>
                    {{ $vente->client->prenom }}
                    {{ $vente->client->nom }}
                </strong>

                <p>
                    {{ $vente->client->email }}
                </p>

                <p>
                    {{ $vente->client->telephone }}
                </p>

                @if($vente->client->adresse)

                    <p>
                        {{ $vente->client->adresse }}
                    </p>

                @endif

            </div>


            <div class="info-box">

                <h3>Informations de vente</h3>

                <p>
                    <strong>Date de vente :</strong>
                    {{ $vente->date_vente->format('d/m/Y') }}
                </p>

                <p>
                    <strong>Paiement :</strong>
                    {{ $vente->mode_paiement }}
                </p>

                <p>
                    <strong>Statut :</strong>
                    {{ $vente->statut }}
                </p>

            </div>

        </div>


        {{-- VEHICULE --}}
        <table class="invoice-table">

            <thead>

                <tr>
                    <th>Description</th>
                    <th class="text-right">Quantité</th>
                    <th class="text-right">Prix unitaire</th>
                    <th class="text-right">Total</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>

                        <div class="vehicle-name">
                            {{ $vente->vehicule->marque->nom }}
                            {{ $vente->vehicule->modele }}
                        </div>

                        <div class="vehicle-details">

                            Année :
                            {{ $vente->vehicule->annee }}

                            ·

                            {{ $vente->vehicule->carburant }}

                            ·

                            {{ $vente->vehicule->boite_vitesse }}

                            ·

                            {{ number_format($vente->vehicule->kilometrage, 0, ',', ' ') }}
                            km

                        </div>

                    </td>

                    <td class="text-right">
                        1
                    </td>

                    <td class="text-right">
                        {{ number_format($vente->prix_vente, 0, ',', ' ') }} Ar
                    </td>

                    <td class="text-right">

                        <strong>
                            {{ number_format($vente->prix_vente, 0, ',', ' ') }} Ar
                        </strong>

                    </td>

                </tr>

            </tbody>

        </table>


        {{-- TOTAL --}}
        <div class="total-section">

            <div class="total-box">

                <div class="total-row">

                    <span>
                        Sous-total
                    </span>

                    <strong>
                        {{ number_format($vente->prix_vente, 0, ',', ' ') }} Ar
                    </strong>

                </div>


                <div class="total-row">

                    <span>
                        Taxes
                    </span>

                    <strong>
                        0 Ar
                    </strong>

                </div>


                <div class="total-final">

                    <span>
                        Total à payer
                    </span>

                    <strong>
                        {{ number_format($vente->prix_vente, 0, ',', ' ') }} Ar
                    </strong>

                </div>

            </div>

        </div>


        {{-- PAIEMENT --}}
        <div class="payment">

            <strong>
                Mode de paiement :
            </strong>

            <span>
                {{ $vente->mode_paiement }}
            </span>

        </div>


        {{-- FOOTER --}}
        <div class="invoice-footer">

            <div class="thank-you">
                Merci pour votre confiance.
            </div>

            LUXORA MOTORS — Vente & Importation Automobile<br>

            Cette facture constitue un justificatif de la transaction effectuée.

        </div>

    </div>

</div>

@endsection