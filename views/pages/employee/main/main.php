<?php $this->layout('layout_employee') ?>
<?php $this->section('content'); ?>
<!-- BEGIN PROFILE -->
<div class="tab-pane active" id="profile">
    <p class="lead">My Profile</p>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <p><strong>Email:</strong> <a href="mailto:jwilliams@gmail.com">bootdey@bootdey.com</a></p>
            <p><strong>Website:</strong> <a href="jwilliams.com">bootdey.com</a></p>
            <p><strong>About:</strong> Web Designer / UI Designer</p>
            <p><strong>Joined on:</strong> July 24<sup>th</sup>, 2010</p>
            <p><strong>Hobbies:</strong> Read books, hang out, learn history, making website</p>
            <p><strong>Skills:</strong> <span class="label label-primary">HTML</span>, <span class="label label-primary">CSS</span>, <span class="label label-primary">JAVASCRIPT</span>, <span class="label label-primary">JQUERY</span>, <span class="label label-primary">AJAX</span>, <span class="label label-primary">PHP</span>, <span class="label label-primary">RUBY</span>, <span class="label label-primary">PHYTON</span>, <span class="label label-primary">C</span></p>
        </div>
        <div class="col-md-6">
            <p><strong>Address:</strong> bootdey City, NY, USA</p>
            <p><strong>Phone:</strong> (123) 456-5644</p>
            <p><strong>Phone + Ext:</strong> (123) 1111-2222 1111</p>
            <p><strong>Reputation:</strong> <span class="text-green"><i class="fa fa-angle-up"></i> 2000</span></p>
            <p><strong>Rating:</strong> <span class="text-yellow"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-half-o"></i></span></p>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4 stats">
            <h1>46,2K</h1>
            <span>Followes</span>
            <button class="btn btn-success"><i class="fa fa-plus-circle"></i> Follow</button>
        </div>
        <div class="col-sm-4 stats">
            <h1>127</h1>
            <span>Following</span>
            <button class="btn btn-info"><i class="fa fa-user"></i> View Profile</button>
        </div>
        <div class="col-sm-4 stats">
            <h1>10,9K</h1>
            <span>Subscribers</span>
            <button class="btn btn-danger"><i class="fa fa-rss"></i> Subscribe</button>
        </div>
    </div>
</div>
<!-- END PROFILE -->
<!-- BEGIN TIMELINE -->
<div class="tab-pane" id="timeline">
    <p class="lead">My Timeline</p>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="timeline-centered">
                <article class="timeline-entry">
                    <div class="timeline-entry-inner">
                        <time class="timeline-time" datetime="2014-01-10T03:45"><span>11:41 AM</span> <span>Today</span></time>

                        <div class="timeline-icon bg-primary">
                            <i class="fa fa-home"></i>
                        </div>

                        <div class="timeline-label">
                            <h2><a href="#">Jeffrey Williams</a> <span>posted a status update</span></h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                        </div>
                    </div>
                </article>

                <article class="timeline-entry left-aligned">
                    <div class="timeline-entry-inner">
                        <time class="timeline-time" datetime="2014-01-10T03:45"><span>08:12 AM</span> <span>Today</span></time>

                        <div class="timeline-icon bg-warning">
                            <i class="fa fa-bell"></i>
                        </div>

                        <div class="timeline-label">
                            <h2><a href="#">Job Meeting</a></h2>
                            <p>You have a meeting at <strong>10:00 AM</strong> in the <strong>Meeting Room</strong>.</p>
                        </div>
                    </div>
                </article>

                <article class="timeline-entry">
                    <div class="timeline-entry-inner">
                        <time class="timeline-time" datetime="2014-01-10T03:45"><span>02:10 AM</span> <span>15/06/2014</span></time>

                        <div class="timeline-icon bg-danger">
                            <i class="fa fa-user"></i>
                        </div>

                        <div class="timeline-label">
                            <h2><a href="#">Larry Gardner</a> <span>changed his</span> <a href="#">Profile Picture</a></h2>
                            <blockquote>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</blockquote>
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-responsive img-rounded full-width" alt="">
                        </div>
                    </div>
                </article>

                <article class="timeline-entry begin">
                    <div class="timeline-entry-inner">
                        <div class="timeline-icon bg-default">
                            <i class="fa fa-laptop"></i>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>
<!-- END TIMELINE -->
<!-- BEGIN PHOTOS -->
<div class="tab-pane" id="photos">
    <p class="lead">My Photos</p>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="popup-gallery">
                <a href="https://www.bootdey.com/image/128x100/" title="Photo 1"><img src="https://www.bootdey.com/image/128x100/" alt=""></a>
                <a href="https://www.bootdey.com/image/128x100/" title="Photo 2"><img src="https://www.bootdey.com/image/128x100/" alt=""></a>
                <a href="https://www.bootdey.com/image/128x100/" title="Photo 3"><img src="https://www.bootdey.com/image/128x100/" alt=""></a>
                <a href="https://www.bootdey.com/image/128x100/" title="Photo 4"><img src="https://www.bootdey.com/image/128x100/" alt=""></a>
                <a href="https://www.bootdey.com/image/128x100/" title="Photo 5"><img src="https://www.bootdey.com/image/128x100/" alt=""></a>
                <a href="https://www.bootdey.com/image/128x100/" title="Photo 6"><img src="https://www.bootdey.com/image/128x100/" alt=""></a>
                <a href="https://www.bootdey.com/image/128x100/" title="Photo 7"><img src="https://www.bootdey.com/image/128x100/" alt=""></a>
                <a href="https://www.bootdey.com/image/128x100/" title="Photo 8"><img src="https://www.bootdey.com/image/128x100/" alt=""></a>
                <a href="https://www.bootdey.com/image/128x100/" title="Photo 1"><img src="https://www.bootdey.com/image/128x100/" alt=""></a>
                <a href="https://www.bootdey.com/image/128x100/" title="Photo 1"><img src="https://www.bootdey.com/image/128x100/" alt=""></a>
                <a href="https://www.bootdey.com/image/128x100/" title="Photo 3"><img src="https://www.bootdey.com/image/128x100/" alt=""></a>
                <a href="https://www.bootdey.com/image/128x100/" title="Photo 4"><img src="https://www.bootdey.com/image/128x100/" alt=""></a>
                <a href="https://www.bootdey.com/image/128x100/" title="Photo 5"><img src="https://www.bootdey.com/image/128x100/" alt=""></a> <a href="https://www.bootdey.com/image/128x100/" title="Photo 1"><img src="https://www.bootdey.com/image/128x100/" alt=""></a>
            </div>
            <br>
        </div>
    </div>
</div>
<!-- END PHOTOS -->
<!-- BEGIN SETTINGS -->
<div class="tab-pane" id="settings">
    <p class="lead">My Settings</p>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-4 control-label">Global Notifications</label>
                    <div class="col-sm-2">
                        <input type="checkbox" />
                    </div>
                    <label class="col-sm-2 control-label">Email Notifications</label>
                    <div class="col-sm-2">
                        <input type="checkbox" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Phone Notifications</label>
                    <div class="col-sm-2">
                        <input type="checkbox" />
                    </div>
                    <label class="col-sm-2 control-label">Mail Notifications</label>
                    <div class="col-sm-2">
                        <input type="checkbox" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label">Subscribe Newsletters</label>
                    <div class="col-sm-2">
                        <input type="checkbox" />
                    </div>
                    <label class="col-sm-2 control-label">RSS Feeds</label>
                    <div class="col-sm-2">
                        <input type="checkbox" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SETTINGS -->
<?php $this->end(); ?>