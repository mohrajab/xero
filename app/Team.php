<?php

namespace App;

use Laravel\Spark\Team as SparkTeam;

/**
 * App\Team
 *
 * @property-read string $email
 * @property-read string|null $photo_url
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\Invitation[] $invitations
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\LocalInvoice[] $localInvoices
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \App\User $owner
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Point[] $points
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Spark\TeamSubscription[] $subscriptions
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @mixin \Eloquent
 */
class Team extends SparkTeam
{
    public function points()
    {
        return $this->hasMany(Point::class);
    }
}
