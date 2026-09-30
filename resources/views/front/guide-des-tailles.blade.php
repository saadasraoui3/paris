@extends('layouts.app')

@section('content')
<style>
    .page-hero {
        background: linear-gradient(135deg, var(--bg-cream) 0%, #f5f1ea 100%);
        padding: 4rem 0;
        text-align: center;
        border-bottom: 1px solid #e5e5e5;
    }

    .page-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 3rem;
        font-weight: 300;
        letter-spacing: 2px;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        color: var(--text-light);
        font-size: 1rem;
        max-width: 600px;
        margin: 0 auto;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 4rem 3rem;
    }

    .section-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.2rem;
        font-weight: 400;
        letter-spacing: 1px;
        color: var(--primary-color);
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid var(--accent-color);
    }

    .size-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 3rem;
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        border-radius: 8px;
        overflow: hidden;
    }

    .size-table thead {
        background: linear-gradient(135deg, var(--primary-color) 0%, #2a2a2a 100%);
        color: white;
    }

    .size-table th {
        padding: 1.5rem;
        text-align: left;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .size-table td {
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid #f0f0f0;
    }

    .size-table tbody tr:hover {
        background-color: var(--bg-cream);
    }

    .size-table tbody tr:last-child td {
        border-bottom: none;
    }

    .dimension-card {
        background: var(--bg-cream);
        padding: 2rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        border-left: 4px solid var(--accent-color);
    }

    .dimension-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: var(--primary-color);
        margin-bottom: 1rem;
    }

    .dimension-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .dimension-item {
        background: white;
        padding: 1.5rem;
        border-radius: 6px;
        text-align: center;
    }

    .dimension-label {
        color: var(--text-light);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .dimension-value {
        font-size: 1.8rem;
        font-weight: 600;
        color: var(--accent-color);
    }

    .tips-section {
        background: linear-gradient(135deg, rgba(201, 168, 124, 0.1) 0%, rgba(212, 165, 116, 0.1) 100%);
        padding: 2.5rem;
        border-radius: 8px;
        margin-top: 3rem;
    }

    .tips-title {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.5rem;
        color: var(--primary-color);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .tip-item {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.2rem;
    }

    .tip-icon {
        color: var(--accent-color);
        font-size: 1.5rem;
        flex-shrink: 0;
    }

    .tip-text {
        color: var(--text-light);
        line-height: 1.8;
    }

    .return-policy {
        background: white;
        padding: 2rem;
        border-radius: 8px;
        margin-top: 2rem;
        border: 1px solid #e5e5e5;
    }

    .return-policy h3 {
        color: var(--primary-color);
        margin-bottom: 1rem;
        font-size: 1.2rem;
    }

    .return-policy p {
        color: var(--text-light);
        margin-bottom: 0.8rem;
        line-height: 1.8;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }

        .container {
            padding: 2rem 1.5rem;
        }

        .section-title {
            font-size: 1.8rem;
        }

        .size-table {
            font-size: 0.9rem;
        }

        .size-table th,
        .size-table td {
            padding: 1rem;
        }

        .dimension-content {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="page-hero">
    <div class="container">
        <h1 class="page-title">Guide des Tailles</h1>
        <p class="page-subtitle">Trouvez votre taille parfaite avec notre guide complet</p>
    </div>
</div>

<div class="container">
    <!-- Standard Sizes -->
    <section>
        <h2 class="section-title">Dimensions Standard des Foulards</h2>

        <table class="size-table">
            <thead>
                <tr>
                    <th>Type de Foulard</th>
                    <th>Longueur</th>
                    <th>Largeur</th>
                    <th>Utilisation</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong>Carré Petit</strong></td>
                    <td>60 × 60 cm</td>
                    <td>Petit</td>
                    <td>Cheveux, cou, accessoire</td>
                </tr>
                <tr>
                    <td><strong>Carré Moyen</strong></td>
                    <td>85 × 85 cm</td>
                    <td>Moyen</td>
                    <td>Cou, tête, accessoire polyvalent</td>
                </tr>
                <tr>
                    <td><strong>Carré Grand</strong></td>
                    <td>100 × 100 cm</td>
                    <td>Grand</td>
                    <td>Écharpe, châle, accessoire statement</td>
                </tr>
                <tr>
                    <td><strong>Foulard Rectangulaire</strong></td>
                    <td>180 × 90 cm</td>
                    <td>Rectangulaire</td>
                    <td>Écharpe classique, châle léger</td>
                </tr>
                <tr>
                    <td><strong>Foulard Long</strong></td>
                    <td>220 × 110 cm</td>
                    <td>Long</td>
                    <td>Étole, accessoire volumineux</td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- How to Measure -->
    <section>
        <h2 class="section-title">Comment Mesurer Votre Cou</h2>

        <div class="dimension-card">
            <h3 class="dimension-title">Mesure du Tour de Cou</h3>
            <div class="dimension-content">
                <div class="dimension-item">
                    <div class="dimension-label">Petit</div>
                    <div class="dimension-value">35-37 cm</div>
                </div>
                <div class="dimension-item">
                    <div class="dimension-label">Moyen</div>
                    <div class="dimension-value">38-40 cm</div>
                </div>
                <div class="dimension-item">
                    <div class="dimension-label">Grand</div>
                    <div class="dimension-value">41-43 cm</div>
                </div>
                <div class="dimension-item">
                    <div class="dimension-label">Très Grand</div>
                    <div class="dimension-value">44+ cm</div>
                </div>
            </div>
        </div>

        <div class="tips-section">
            <h3 class="tips-title">Conseils de Mesure</h3>
            <div class="tip-item">
                <div class="tip-icon">✓</div>
                <div class="tip-text">Utilisez un mètre souple non extensible pour la précision</div>
            </div>
            <div class="tip-item">
                <div class="tip-icon">✓</div>
                <div class="tip-text">Mesurez autour de la partie la plus large de votre cou</div>
            </div>
            <div class="tip-item">
                <div class="tip-icon">✓</div>
                <div class="tip-text">Assurez-vous que le mètre n'est pas trop serré</div>
            </div>
            <div class="tip-item">
                <div class="tip-icon">✓</div>
                <div class="tip-text">Pour les châles, mesurez votre carrure pour le meilleur ajustement</div>
            </div>
        </div>
    </section>

    <!-- Style Guide -->
    <section>
        <h2 class="section-title">Conseils de Style par Type de Foulard</h2>

        <div class="dimension-card">
            <h3 class="dimension-title">Carré Petit (60×60 cm)</h3>
            <p style="color: var(--text-light); line-height: 1.8;">
                Parfait pour accessoiriser vos cheveux, créer un bandeau stylé ou nouer autour de votre cou de manière sophistiquée. Idéal pour les tenues professionnelles.
            </p>
        </div>

        <div class="dimension-card">
            <h3 class="dimension-title">Carré Moyen (85×85 cm)</h3>
            <p style="color: var(--text-light); line-height: 1.8;">
                Le classique intemporel. À nouer autour du cou, utiliser comme couvre-chef ou accessoire de sac. Offre une grande flexibilité de port.
            </p>
        </div>

        <div class="dimension-card">
            <h3 class="dimension-title">Carré Grand (100×100 cm)</h3>
            <p style="color: var(--text-light); line-height: 1.8;">
                Parfait comme châle léger, élément de décoration ou accessoire volumineux. Permet diverses façons de le porter pour un impact maximum.
            </p>
        </div>

        <div class="dimension-card">
            <h3 class="dimension-title">Foulard Rectangulaire (180×90 cm)</h3>
            <p style="color: var(--text-light); line-height: 1.8;">
                L'écharpe classique par excellence. Parfaite pour les jours frais, à enrouler autour du cou ou à draper élégamment sur les épaules.
            </p>
        </div>
    </section>

    <!-- Return Policy -->
    <div class="return-policy">
        <h3>📋 Politique de Retour Liée aux Tailles</h3>
        <p>
            Si la taille ne vous convient pas, nous acceptons les retours sous <strong>30 jours</strong> après réception de votre commande.
        </p>
        <p>
            Le foulard doit être dans son état original, non porté et sans défauts pour être éligible à un échange ou un remboursement.
        </p>
    </div>
</div>

@endsection
