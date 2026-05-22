{{--
    EXERCICE — Question 2 : Composant Blade anonyme — pied de page public
    Question 7 : lien "Admin" vers le dashboard via route('dashboard.index').
--}}
<footer>
    <span>© {{ date('Y') }} Le Blog. Tous droits réservés.</span>
    <div>
        <a href="#">Mentions légales</a>
        <a href="#">Confidentialité</a>
        <a href="{{ route('dashboard.index') }}">Admin</a>
    </div>
</footer>
