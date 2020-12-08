<!-- Blog Comments -->
<div class="comments1">
    <div class="well">
        <h4>Bình luận:</h4>
        <form action="{{route('comment.store')}}" method="post">
            @csrf
            <div class="form-group">
                <input type="hidden" name="id" value="{{$post->p_id}}">
                <textarea class="form-control" rows="3" name="comment"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Gửi</button>
        </form>
    </div>
    <hr>
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="{{asset('client/images/avatar1.png')}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">Author Name
                <small>August 25, 2014 at 9:30 PM</small>
            </h4>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin
            commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum
            nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
        </div>
    </div>
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="{{asset('client/images/avatar1.png')}}" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading">Author Name
                <small>August 25, 2014 at 9:30 PM</small>
            </h4>
            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin
            commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum
            nunc ac nisi vulputate fringilla.
            <div class="media">
                <a class="pull-left" href="#">
                    <img class="media-object" src="{{asset('client/images/avatar1.png')}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">Author Name
                        <small>August 25, 2014 at 9:30 PM</small>
                    </h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante
                    sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra
                    turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis
                    in faucibus.
                </div>
            </div>
        </div>
    </div>
</div>