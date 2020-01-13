<div class="  col-md-9 col-lg-9 mt-2 float-left" style="width: 1200px">

    <div class="card" style="zz">
        <div class="card-heading">
            <div class="col-sm-12">
                <h3>User Comment </h3>
            </div><!-- /col-sm-12 -->
        </div>
        <div class="card-body">
            <div class="row">
            </div><!-- /row -->
            <div class="row container-fluid ">


                @foreach($job->comments as $comment)
                    <div class="col-sm-1 pb-1" style="resize: both">
                        <div class="thumbnail">
                            <img class="img-responsive user-photo img-fluid img-thumbnail"
                                 src="/uploads/avatars/{{ $comment->user->avatar }}">
                        </div><!-- /thumbnail -->
                    </div><!-- /col-sm-1 -->
                    <div class="col-sm-11 pb-1">
                        <div class="card card-default">
                            <div class="card-heading pl-1">
                                <strong>{{ $comment->user->name}}</strong> <span
                                        class="text-muted">commented on {{ $comment->created_at}}</span>
                            </div>
                            <div class="card-body">
                                {{ $comment->body }}
                            </div><!-- /card-body -->
                        </div><!-- /card card-default -->
                    </div><!-- /col-sm-5 -->

                @endforeach

            </div><!-- /row -->


        </div>
    </div>
</div>
