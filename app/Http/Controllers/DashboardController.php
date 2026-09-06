<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\RendezVous;
use App\Models\Vehicule;
use App\Models\Vente;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $role = $user->role;

        $statistiques = $this->getStatistiques($role);
        $evolutionVentes = $this->getEvolutionVentes();
        $prochainsRendezVous = $this->getProchainsRendezVous();
        $dernieresVentes = $this->getDernieresVentes();
        $meilleursVehicules = $this->getMeilleursVehicules($role);

        return view('dashboard', array_merge(
            $statistiques,
            [
                'evolutionVentes' => $evolutionVentes,
                'prochainsRendezVous' => $prochainsRendezVous,
                'dernieresVentes' => $dernieresVentes,
                'meilleursVehicules' => $meilleursVehicules,
                'role' => $role,
            ]
        ));
    }

    /**
     * Statistiques générales du dashboard.
     */
    private function getStatistiques(string $role): array
    {
        $chiffreAffaires = Vente::where('statut', 'Confirmee')
            ->sum('prix_vente');

        $totalClients = Client::count();

        $totalRendezVous = RendezVous::count();

        $totalVentes = Vente::count();

        $ventesConfirmees = Vente::where('statut', 'Confirmee')
            ->count();

        $ventesEnAttente = Vente::where('statut', 'En attente')
            ->count();

        $ventesAnnulees = Vente::where('statut', 'Annulee')
            ->count();

        /*
         * Les informations concernant les véhicules
         * sont réservées à l'administrateur et au gestionnaire.
         */
        if (in_array($role, ['administrateur', 'gestionnaire'])) {

            $totalVehicules = Vehicule::count();

            $vehiculesDisponibles = Vehicule::where(
                'statut',
                'Disponible'
            )->count();

            $vehiculesVendus = Vehicule::where(
                'statut',
                'Vendu'
            )->count();

            $vehiculesReserves = Vehicule::where(
                'statut',
                'Reserve'
            )->count();

        } else {

            $totalVehicules = 0;
            $vehiculesDisponibles = 0;
            $vehiculesVendus = 0;
            $vehiculesReserves = 0;
        }

        return [
            'chiffreAffaires' => $chiffreAffaires,

            'totalVehicules' => $totalVehicules,

            'totalClients' => $totalClients,

            'totalRendezVous' => $totalRendezVous,

            'totalVentes' => $totalVentes,

            'vehiculesDisponibles' => $vehiculesDisponibles,

            'vehiculesVendus' => $vehiculesVendus,

            'vehiculesReserves' => $vehiculesReserves,

            'ventesConfirmees' => $ventesConfirmees,

            'ventesEnAttente' => $ventesEnAttente,

            'ventesAnnulees' => $ventesAnnulees,
        ];
    }

    /**
     * Evolution des ventes sur les 6 derniers mois.
     */
    private function getEvolutionVentes()
    {
        $evolutionVentes = collect();

        for ($i = 5; $i >= 0; $i--) {

            $date = Carbon::now()->subMonths($i);

            $ventes = Vente::where('statut', 'Confirmee')
                ->whereYear('date_vente', $date->year)
                ->whereMonth('date_vente', $date->month)
                ->count();

            $revenu = Vente::where('statut', 'Confirmee')
                ->whereYear('date_vente', $date->year)
                ->whereMonth('date_vente', $date->month)
                ->sum('prix_vente');

            $evolutionVentes->push([
                'mois' => $date->translatedFormat('M'),
                'ventes' => $ventes,
                'revenu' => $revenu,
            ]);
        }

        return $evolutionVentes;
    }

    /**
     * Récupère les prochains rendez-vous.
     */
    private function getProchainsRendezVous()
    {
        return RendezVous::with([
                'client',
                'vehicule.marque'
            ])
            ->whereDate(
                'date_rendez_vous',
                '>=',
                Carbon::today()
            )
            ->where('statut', '!=', 'Annul')
            ->orderBy('date_rendez_vous')
            ->orderBy('heure')
            ->limit(5)
            ->get();
    }

    /**
     * Récupère les dernières ventes.
     */
    private function getDernieresVentes()
    {
        return Vente::with([
                'client',
                'vehicule.marque'
            ])
            ->orderByDesc('date_vente')
            ->limit(5)
            ->get();
    }

    /**
     * Récupère les véhicules les plus vendus.
     */
    private function getMeilleursVehicules(string $role)
    {
        if (!in_array($role, ['administrateur', 'gestionnaire'])) {
            return collect();
        }

        return Vente::where('statut', 'Confirmee')
            ->selectRaw(
                'vehicule_id, COUNT(*) as total_ventes'
            )
            ->groupBy('vehicule_id')
            ->orderByDesc('total_ventes')
            ->limit(5)
            ->with([
                'vehicule.marque'
            ])
            ->get();
    }
}
