<aside class="col-md-4 blog-sidebar">

    <div class="p-4 mb-3 bg-light rounded">

        <h4 class="font-italic">Облако тэгов</h4>
        <br>

        <h5>Тэги постов</h5>

        @include('tags.show', ['tagsPost' => $tagsPostCloud])

        <h5>Тэги новостей</h5>

        @include('tags.show', ['tagsNews' => $tagsNewsCloud])

        @auth()
            <h5>Тэги задач</h5>

            @include('tags.show', ['tagsTask' => $tagsTaskCloud])
            <br>
        @endauth
    </div>

</aside>
