@extends('layout')

@section('content')
    <div class="student-cards">
        <div class="gallery">
            <ul class="cards">
                <li class="card">Testna 1</li>
                <li class="card">Testna 2</li>
                <li class="card">Testna 3</li>
                <li class="card">Testna 4</li>
                <li class="card">Testna 5</li>
                <li class="card">Testna 6</li>
                <li class="card">Testna 7</li>
                <li class="card">Testna 8</li>
                <li class="card">Testna 9</li>
                <li class="card">Testna 10</li>
                <li class="card">Testna 11</li>
                <li class="card">Testna 12</li>
                @if (!$data->isEmpty())
                    @if (count($data) > 0)
                        @foreach ($data as $row)
                            <li class="card">
                                <div class="logo"><img src="{{Storage::url('images/'.$row->logo)}}" alt="KER logo">
                                    <div>
                                        <h4>{{$row->name}}</h4>
                                    </div>
                                </div>
                                <div class="info">
                                    <div class="user-info">
                                        <h3>{{$row->user_name}} {{$row->user_surname}}</h3>
                                    </div>
                                    <div class="org-info">
                                        <div class="valid-since"><h3>Veljavno od: <br>{{$row->created_at}}</h3></div>
                                        <div class="granted-by"><h3>Izdal: <br>{{$row->o_name}}</h3></div>
                                    </div>
                                </div>
                                <a href="{{ route('student.qrcode-generate', ['cardId' => $row->id]) }}">
                                    <div class="btn-verify">
                                        <h3>Verifikacija veljavnosti</h3>
                                    </div>
                                </a>
                                <div class="card-id">
                                    <p>Št. izkaznice: <br> {{$row->ucId}}</p>
                                </div>
                            </li>
                        @endforeach
                    @endif
                @else
                    <div class="no-data">
                        <h1>Ni dodeljenih kartic</h1>
                    </div>
                @endif
            </ul>
        </div>
    </div>
    <div class="actions">
        <div class="prev"><i class="fa-solid fa-circle-left"></i></div>
        <div class="next"><i class="fa-solid fa-circle-right"></i></div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <script>
        gsap.registerPlugin(ScrollTrigger);

        let iteration = 0;
        const spacing = 0.12;
        const cards = gsap.utils.toArray('.cards li');
        const seamlessLoop = buildSeamlessLoop(cards, spacing);
        const scrub = gsap.to(seamlessLoop, {
            totalTime: 0,
            duration: 0.5,
            ease: "easeOut",
            paused: true,
        });

        function wrapForward() {

            iteration++;
            let totalTime = iteration * seamlessLoop.duration() / cards.length;
            if (iteration >= cards.length ) {
                // Reset to the first card
                iteration = 0;
                totalTime = 0;
                seamlessLoop.totalTime(totalTime);
                scrubTo(0.01)// Reset the loop timeline as well
            } else {
                scrubTo(totalTime);
            }


            // iteration++;
            // if (iteration >= cards.length) {
            //     seamlessLoop.totalTime(seamlessLoop.totalTime() + seamlessLoop.duration());
            // }
            // scrubTo((iteration) * seamlessLoop.duration() / cards.length);
        }

        function wrapBackward() {
            iteration--;
            if (iteration < 0) {
                iteration = cards.length -1;
                seamlessLoop.totalTime(seamlessLoop.totalTime() + seamlessLoop.duration());
            }
            scrubTo(iteration * seamlessLoop.duration() / cards.length);
        }

        function scrubTo(totalTime) {
            scrub.vars.totalTime = totalTime;
            scrub.invalidate().restart();
        }

        document.querySelector(".next").addEventListener("click", wrapForward);
        document.querySelector(".prev").addEventListener("click", wrapBackward);

        function buildSeamlessLoop(items, spacing) {
            let overlap = Math.ceil(1 / spacing), // number of EXTRA animations on either side of the start/end to accommodate the seamless looping
                startTime = items.length * spacing + 0.5, // the time on the rawSequence at which we'll start the seamless loop
                loopTime = (items.length + overlap) * spacing + 1, // the spot at the end where we loop back to the startTime
                rawSequence = gsap.timeline({paused: true}), // this is where all the "real" animations live
                seamlessLoop = gsap.timeline({ // this merely scrubs the playhead of the rawSequence so that it appears to seamlessly loop
                    paused: true,
                    repeat: -1, // to accommodate infinite scrolling/looping
                    onRepeat() { // works around a super rare edge case bug that's fixed GSAP 3.6.1
                        this._time === this._dur && (this._tTime += this._dur - 0.01);
                    }
                }),
                l = items.length + overlap * 2,
                time = 0,
                i, index, item;

            // set initial state of items
            gsap.set(items, {xPercent: 400, opacity: 0,	scale: 0});

            // now loop through and create all the animations in a staggered fashion. Remember, we must create EXTRA animations at the end to accommodate the seamless looping.
            for (i = 0; i < l; i++) {
                index = i % items.length;
                item = items[index];
                time = i * spacing;
                rawSequence.fromTo(item, {scale: 0, opacity: 0}, {scale: 1, opacity: 1, zIndex: 100, duration: 0.5, yoyo: true, repeat: 1, ease: "power1.in", immediateRender: false}, time)
                    .fromTo(item, {xPercent: 400}, {xPercent: -400, duration: 1, ease: "none", immediateRender: false}, time);
                i <= items.length && seamlessLoop.add("label" + i, time); // we don't really need these, but if you wanted to jump to key spots using labels, here ya go.
            }

            // here's where we set up the scrubbing of the playhead to make it appear seamless.
            rawSequence.time(startTime);
            seamlessLoop.to(rawSequence, {
                time: loopTime,
                duration: loopTime - startTime,
                ease: "none"
            }).fromTo(rawSequence, {time: overlap * spacing + 1}, {
                time: startTime,
                duration: startTime - (overlap * spacing + 1),
                immediateRender: false,
                ease: "none"
            });
            return seamlessLoop;
        }


        // ... existing buildSeamlessLoop function content remains unchanged ...


    </script>
@endsection
