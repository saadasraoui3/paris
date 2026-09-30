<h2>📩 Nouveau message de contact</h2>

<p><strong>Nom complet :</strong> {{ $data['first_name'] }} {{ $data['last_name'] }}</p>
<p><strong>Email :</strong> {{ $data['email'] }}</p>
<p><strong>Téléphone :</strong> {{ $data['phone'] ?? 'Non renseigné' }}</p>
<p><strong>Sujet :</strong> {{ $data['subject'] }}</p>

<hr>

<p>{{ $data['message'] }}</p>
