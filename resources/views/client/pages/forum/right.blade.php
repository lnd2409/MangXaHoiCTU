<!-- Blog Sidebar Column -->
<aside class="col-md-4 sidebar-padding">
    <div class="blog-sidebar">
        <div class="input-group searchbar">
            <input type="text" class="form-control searchbar" placeholder="Tìm kiếm...">
            <span class="input-group-btn">
                <button class="btn btn-default" type="button">Search</button>
            </span>
        </div><!-- /input-group -->
    </div>
    <!-- Blog Categories -->
    <div class="blog-sidebar">
        <h4 class="sidebar-title"><i class="fa fa-list-ul"></i> Categories</h4>
        <hr>
        <ul class="sidebar-list">
            <li><a href="#">Applications</a></li>
            <li><a href="#">Photography</a></li>
            <li><a href="#">Art Design</a></li>
            <li><a href="#">Graphic Design</a></li>
            <li><a href="#">Category Name</a></li>
        </ul>
    </div>
    <!-- Recent Posts -->
    <div class="blog-sidebar">
        <h4 class="sidebar-title"><i class="fa fa-align-left"></i> Recent Posts</h4>
        <hr style="margin-bottom: 5px;">

        <div class="media">
            <a class="pull-left" href="#">
                <img class="img-responsive media-object" src="{{asset('client/images/blog1.jpg')}}" alt="Media Object">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><a href="#">Post title 1</a></h4>
                This is some sample text. This is some sample text. This is some sample text.
            </div>
        </div>

        <div class="media">
            <a class="pull-left" href="#">
                <img class="img-responsive media-object" src="{{asset('client/images/blog2.jpg')}}" alt="Media Object">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><a href="#">Post title 2</a></h4>
                This is some sample text. This is some sample text. This is some sample text.
            </div>
        </div>

        <div class="media">
            <a class="pull-left" href="#">
                <img class="img-responsive media-object" src="{{asset('client/images/blog3.jpg')}}" alt="Media Object">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><a href="#">Post title 3</a></h4>
                This is some sample text. This is some sample text. This is some sample text.
            </div>
        </div>
        <div class="media">
            <a class="pull-left" href="#">
                <img class="img-responsive media-object" src="{{asset('client/images/blog1.jpg')}}" alt="Media Object">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><a href="#">Post title 4</a></h4>
                This is some sample text. This is some sample text. This is some sample text.
            </div>
        </div>
    </div>

    <div class="blog-sidebar">
        <h4 class="sidebar-title"><i class="fa fa-comments"></i> Recent Comments</h4>
        <hr style="margin-bottom: 5px;">
        <ul class="sidebar-list">
            <li>
                <h5 class="blog-title">Author Name</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore</p>
            </li>
            <li>
                <h5 class="blog-title">Author Name</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore</p>
            </li>
            <li>
                <h5 class="blog-title">Author Name</h5>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                    labore et dolore</p>
            </li>
        </ul>
    </div>

</aside>