<div class="container" style="width: 99vw; height: 70vh; display: flex; justify-content: center; align-items: center;">
    <div class="card" style="display: flex; flex-direction: column; align-items: flex-start; justify-content: flex-start;">
        <div>
            <h4>Pozdravljeni, {{$name}} {{$surname}}</h4>
        </div>
        <div>
            <p>Vi ali nekdo, ki ima dostop do Vašega računa je zahteval spremembo gesla za Vaš račun.
                Spremembo gelsa lahko opravite s klikom na spodnji gumb.
            </p>
        </div>
        <div>
            <a href="{{$url}}">{{$url}}</a>
        </div>
        <div class="footer" style="margin-top: 5vh; padding: 1.5rem 2rem; display: flex; flex-direction: column; justify-content: center; align-items: center; background: rgb(168, 160, 215); color: #c0c0c0; text-align: center;">
            <div>
                <p>
                    To sporočilo je avtomatsko, zato nanj prosimo ne odgovarjate. Za dodatna vprašanja smo vam na voljo preko
                    e-pošte <a href="mailto:e-dentiteta@usdd.company" style="color: #c0c0c0; text-decoration: none; cursor: pointer;">e-dentiteta@usdd.comapany</a>.
                </p>
            </div>
            <div class="copyright" style="display: flex; gap: 1rem; color: #c0c0c0;">
                <div>E-dentiteta, {{date('o')}}</div>
                <div>-</div>
                <div>Vse pravice pridržane</div>
            </div>
        </div>

    </div>
</div>


