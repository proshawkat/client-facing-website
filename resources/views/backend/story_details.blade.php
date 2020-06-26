@extends('layouts.app')
@section('back_css')
    <style>
        .timeline:before{
            background-color: transparent !important;
        }
        .my-timeline .timeline .timeline-item{
            margin-left: 0 !important;
        }
        .my-timeline .timeline:before {
            background-color: transparent;
        }

        .my-timeline .timeline .timeline-item {
            margin-left: 0 !important;
        }

        .comments-details button.btn.dropdown-toggle,
        .comments-details .total-comments {
            font-size: 18px;
            font-weight: 500;
            color: #5e5e5e;
        }

        .comments-details {
            padding: 15px 15px;
        }

        .comments .comments .dropdown,
        .comments .dropup {
            position: relative;
        }

        .comments button {
            background-color: transparent;
            border: none;
        }

        .comments .comment-box {
            width: 100%;
            float: left;
            height: 100%;
            background-color: #FAFAFA;
            padding: 10px 10px 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        .comments .add-comment {
            background-color: transparent;
            border: none;
            position: relative;
            margin-bottom: 50px;
        }

        .comments .commenter-pic {
            width: 50px;
            height: 50px;
            display: inline-block;
            border-radius: 100%;
            border: 2px solid #fff;
            overflow: hidden;
            background-color: #fff;
        }

        .comments .add-comment .commenter-name {
            width: 100%;
            padding-left: 75px;
            position: absolute;
            top: 20px;
            left: 0px;
        }

        .comments .add-comment input {
            border-top: 0px;
            border-bottom: 1px solid #ccc;
            border-left: 0px;
            border-right: 0px;
            outline: 0px;
            box-shadow: none;
            border-radius: 0;
            width: 100%;
            padding: 0;
            font-weight: normal;
        }

        .comments .add-comment input:focus {
            border-color: #03a9f4;
            border-width: 2px;
        }

        .comments .add-comment button[type=submit] {
            background-color: #03a9f4;
            color: #fff;
            margin-right: 0px;
        }

        .comments .add-comment button {
            background-color: #f5f5f5;
            margin: 10px 5px;
            font-size: 14px;
            text-transform: uppercase;
            float: right;
        }

        .comments .commenter-name .comment-time {
            font-weight: normal;
            margin-left: 8px;
            font-size: 15px;
        }

        .comments p.comment-txt {
            font-size: 15px;
        }

        .comments .commenter-name {
            display: inline-block;
            position: relative;
            top: -20px;
            left: 10px;
            font-size: 16px;
            font-weight: bold;
        }

        .comments .comment-meta {
            font-size: 14px;
            color: #333;
            padding: 2px 5px 0px;
            line-height: 20px;
            float: right;
        }

        .comments .reply-box {
            display: none;
        }

        .comments .replied {
            background-color: #fff;
            width: 95%;
            float: right;
            margin-top: 15px;
        }

        /*======Responsive CSS=======*/
        @media (max-width: 767px) {
            .comments .commenter-name {
                font-size: 13px;
                top: -5px;
            }

            .comments .commenter-pic {
                width: 40px;
                height: 40px;
            }

            .comments .commenter-name a {
                display: block;
            }

            .comments .commenter-name .comment-time {
                display: block;
                margin-left: 0px;
            }
        }
    </style>
@endsection

@section('content')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="content-wrapper">
                    <div class="timeline">
                <div>
                    <div class="timeline-item mt-5 mb-3">
                        <div class="timeline-header row">
                            <div class="col-md-8">
                                <h4>{{ $story->title }}</h4>
                            </div>
                            <div class="col-md-4 text-right">
                                <a href="{{ route('admin.manage_post') }}" class="btn btn-secondary"><i class="fa fa-arrow-left"></i> Back</a>
                                @if($story->status == 0)
                                    <span class="badge badge-success">Active</span>
                                @elseif($story->status == 1)
                                    <span class="badge badge-danger">Blocked</span>
                                @else
                                    <span class="badge badge-danger">Unlisted</span>
                                @endif
                            </div>
                        </div>
                        <div class="timeline-body">
                            {!! $story->description !!}
                            <div class="">
                                <img style="width: 100%; max-height: 400px; object-fit: cover;" src="{{ url('storage/stories', $story->img) }}" alt="">
                                <h5>{{ $story->img_caption }}</h5>
                            </div>
                        </div>
                        <div class="timeline-footer border-top">
                            <div class="row">
                                <div class="col-md-6 text-center">
                                    <a class="btn btn-sm pointer" href="#"><i class="fa fa-comments"
                                                                              aria-hidden="true"></i>
                                        Comment</a>
                                </div>
                            </div>

                            <div class="container">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="comments">
                                            <div class="comments-details">
                                                <span class="total-comments comments-sort">{{ count($story->comments) }} Comments</span>
                                            </div>
                                            @if($story->comments)
                                                @foreach($story->comments as $comment)
                                                    <div class="comment-box">
                                                                    <span class="commenter-pic">
                                                                        @if($comment->client->avatar)
                                                                            <img style="width: 40px; height: 40px;" src="{{ url('storage/client/', $comment->client->avatar) }}"
                                                                                 class="img-circle img-fluid">
                                                                        @else
                                                                            <img style="width: 40px; height: 40px;" src="{{ url('storage/client/avatar04.png') }}"
                                                                                 class="img-circle img-fluid" alt="">
                                                                        @endif
                                                                    </span>
                                                        <span class="commenter-name">
                                                                        <a href="#">{{ $comment->client->name }}</a>
                                                                        <span class="comment-time">{{ $comment->created_at->diffForHumans() }}</span>
                                                                    </span>
                                                        <p class="comment-txt more border-bottom">{{ $comment->comment }}</p>
                                                        <div class="comment-meta">
                                                            <a href="{{ route('admin.delete.comment', $comment->id) }}" class="comment-reply">
                                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                                                Delete
                                                            </a>
                                                        </div>
                                                        @foreach($comment->replies as $reply)
                                                            <div class="comment-box replied">
                                                                            <span class="commenter-pic">
                                                                                @if($comment->client->avatar)
                                                                                    <img style="width: 40px; height: 40px;" src="{{ url('storage/client/', $reply->client->avatar) }}"
                                                                                         class="img-circle img-fluid">
                                                                                @else
                                                                                    <img style="width: 40px; height: 40px;" src="{{ url('storage/client/avatar04.png') }}"
                                                                                         class="img-circle img-fluid" alt="">
                                                                                @endif
                                                                            </span>
                                                                <span class="commenter-name">
                                                                                <a href="#">{{ $reply->client->name }}</a>
                                                                                <span class="comment-time">{{ $reply->created_at->diffForHumans() }}</span>
                                                                            </span>
                                                                <p class="comment-txt more">{{ $reply->reply }}</p>
                                                                <div class="comment-meta">
                                                                    <a href="{{ route('admin.delete.reply', $reply->id) }}" class="comment-reply">
                                                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                                                        Delete
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
                </div>
            </div>
        </div>
    </section>
@endsection

