<!-- /.blog-main -->
<aside class="col-md-4 blog-sidebar">
    <div class="p-4 mb-3 bg-light rounded">
        <h4 class="font-italic">Облако тэгов</h4>
        <br>
        <h5>Тэги задач</h5>
        @include('tasks.tags', ['tagsTask' => $tagsTaskCloud])
        <br>
        <h5>Тэги постов</h5>
        @include('posts.tags', ['tagsPost' => $tagsPostCloud])
    </div>
</aside>
<!-- /.blog-sidebar -->
