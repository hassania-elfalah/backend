<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chambre extends Model {
    protected $fillable = ['numero', 'etage', 'type_chambre_id', 'prix', 'statut', 'atmosphere'];
    
    protected $casts = [
        'statut' => 'string',
        'prix' => 'decimal:2'
    ];
    
    public function typeChambre() {
        return $this->belongsTo(TypeChambre::class, 'type_chambre_id');
    }
    
    public function reservations() {
        return $this->hasMany(Reservation::class);
    }
    
    public function images() {
        return $this->hasMany(ImageChambre::class);
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
    
    // Vérifier disponibilité
    public function estDisponible($dateDebut, $dateFin) {
        return !$this->reservations()
            ->where('statut', '!=', 'annulee')
            ->where(function($query) use ($dateDebut, $dateFin) {
                $query->where('date_arrivee', '<', $dateFin)
                      ->where('date_depart', '>', $dateDebut);
            })
            ->exists();
    }
}