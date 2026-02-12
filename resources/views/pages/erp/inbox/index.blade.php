@extends('layout.erp.app')
@section('title', 'Inbox')
@section('dashboard', 'Inbox')

@section('content')
<style>
    /* Inbox Specific Styles */
    .email-left-box {
        background: white;
        padding: 20px;
        border-radius: 20px;
        height: 100%;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    }
    
    .email-right-box {
        background: white;
        border-radius: 20px;
        padding: 0;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        min-height: 600px;
    }
    
    .btn-compose {
        background: #FF7F50;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 10px;
        font-weight: 600;
        width: 100%;
        margin-bottom: 20px;
        transition: all 0.3s;
        box-shadow: 0 4px 15px rgba(255, 127, 80, 0.3);
    }
    
    .btn-compose:hover {
        background: #ff6347;
        color: white;
        transform: translateY(-2px);
    }
    
    .mail-list a {
        display: flex;
        align-items: center;
        padding: 12px 15px;
        color: #7f8c8d;
        border-radius: 10px;
        margin-bottom: 5px;
        transition: all 0.2s;
        text-decoration: none;
        font-weight: 500;
    }
    
    .mail-list a:hover {
        background: #FFF5F2;
        color: #FF7F50;
    }
    
    .mail-list a.active {
        background: rgba(255, 127, 80, 0.1);
        color: #FF7F50;
        font-weight: 600;
    }
    
    .mail-list i {
        font-size: 18px;
        margin-right: 15px;
        width: 20px;
        text-align: center;
    }
    
    .email-list-header {
        padding: 15px 25px;
        border-bottom: 1px solid #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    
    .message-item {
        padding: 20px 25px;
        border-bottom: 1px solid #f8f9fa;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: flex-start;
    }
    
    .message-item:hover {
        background: #fafafa;
        border-left: 3px solid #FF7F50;
    }
    
    .message-item.unread {
        background: #fff;
        font-weight: 600;
    }
    
    .message-item.unread .subject {
        color: #2c3e50;
        font-weight: 700;
    }
    
    .sender-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 600;
        font-size: 16px;
        margin-right: 15px;
        flex-shrink: 0;
    }
    
    .message-content {
        flex-grow: 1;
        min-width: 0; /* Prevents text overflow */
    }
    
    .message-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 5px;
    }
    
    .sender-name {
        font-size: 15px;
        color: #2c3e50;
    }
    
    .message-time {
        font-size: 12px;
        color: #95a5a6;
        font-weight: 400;
    }
    
    .subject {
        font-size: 14px;
        color: #34495e;
        margin-bottom: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .preview {
        font-size: 13px;
        color: #95a5a6;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-weight: 400;
    }
    
    .star-icon {
        color: #e0e0e0;
        margin-right: 15px;
        cursor: pointer;
        transition: color 0.2s;
    }
    
    .star-icon.starred {
        color: #f1c40f;
    }
    
    .star-icon:hover {
        color: #f1c40f;
    }
    
    /* Category Badges */
    .cat-badge {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 10px;
    }

</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3">
            <div class="email-left-box mb-4">
                <button class="btn btn-compose">
                    <i class="fas fa-plus me-2"></i> Compose
                </button>
                
                <div class="mail-list mt-4">
                    <h5 class="text-uppercase text-muted fs-12 mb-3 ps-3">Folders</h5>
                    <a href="{{ route('inbox.index') }}" class="active">
                        <i class="fas fa-inbox"></i> Inbox 
                        <span class="badge bg-coral text-white ms-auto" style="background-color: #FF7F50;">{{ count(array_filter($emails, fn($e) => $e['unread'])) }}</span>
                    </a>
                    <a href="javascript:void(0)"><i class="fas fa-paper-plane"></i> Sent</a>
                    <a href="javascript:void(0)"><i class="fas fa-star"></i> Important</a>
                    <a href="javascript:void(0)"><i class="fas fa-file-alt"></i> Drafts</a>
                    <a href="javascript:void(0)"><i class="fas fa-trash"></i> Trash</a>
                </div>
                
                <div class="mail-list mt-4">
                    <h5 class="text-uppercase text-muted fs-12 mb-3 ps-3">Categories</h5>
                    <a href="javascript:void(0)"><span class="cat-badge bg-primary"></span> Work</a>
                    <a href="javascript:void(0)"><span class="cat-badge bg-success"></span> Support</a>
                    <a href="javascript:void(0)"><span class="cat-badge bg-info"></span> Social</a>
                    <a href="javascript:void(0)"><span class="cat-badge bg-warning"></span> Updates</a>
                </div>
            </div>
        </div>
        
        <div class="col-lg-9">
            <div class="email-right-box">
                <div class="email-list-header">
                    <div class="d-flex align-items-center">
                        <div class="form-check custom-checkbox me-3">
                            <input type="checkbox" class="form-check-input" id="checkAll">
                            <label class="form-check-label" for="checkAll"></label>
                        </div>
                        <button class="btn btn-light btn-sm me-2" type="button"><i class="fas fa-sync-alt"></i></button>
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">More</button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0)">Mark as Read</a>
                                <a class="dropdown-item" href="javascript:void(0)">Delete</a>
                            </div>
                        </div>
                    </div>
                    <div class="text-muted fs-14">
                        1-{{ count($emails) }} of {{ count($emails) }}
                    </div>
                </div>
                
                <div class="email-list">
                    @forelse($emails as $email)
                    <div class="message-item {{ $email['unread'] ? 'unread' : '' }}">
                        <div class="d-flex align-items-center me-3">
                            <div class="form-check custom-checkbox">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </div>
                        
                        <div class="star-icon {{ $email['starred'] ? 'starred' : '' }}">
                            <i class="{{ $email['starred'] ? 'fas' : 'far' }} fa-star"></i>
                        </div>
                        
                        <div class="sender-avatar bg-{{ $email['avatar_color'] }}">
                            {{ substr($email['sender'], 0, 1) }}
                        </div>
                        
                        <div class="message-content">
                            <div class="message-header">
                                <span class="sender-name">{{ $email['sender'] }}</span>
                                <span class="message-time">{{ $email['time'] }}</span>
                            </div>
                            <div class="subject">{{ $email['subject'] }}</div>
                            <div class="preview">{{ $email['preview'] }}</div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center p-5">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <p class="text-muted">No messages found</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
