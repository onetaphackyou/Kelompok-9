<style>
    /* Shared minimal overrides (keep using resources/css/style.css as source of truth) */
    .main{margin-left:0; padding:20px; width:100%; min-height:100vh; transition:margin-left .3s ease, width .3s ease;}
    .sidebar:not(.closed) + .main{margin-left:280px; width:calc(100% - 280px);}
    @media (max-width:768px){.main{padding-left:14px; padding-right:14px; margin-left:0 !important; width:100% !important;}}

    /* Sidebar + header + card-stat styling only if not covered */



    /* Sidebar */
    .sidebar{display:block !important;}
    .sidebar.closed{display:block !important; left: -280px !important;}
    .sidebar h3{display:block !important;}
    .sidebar a{display:block !important;}
    .submenu{display:block !important;}
    .submenu-items a{display:block !important;}
    /* Navbar */
    .top-navbar{
        background: linear-gradient(135deg, #0c6cf2 0%, #1586ff 100%);
        color: #fff;
        border-radius: 18px;
        padding: 18px 24px;
        margin: 16px 0 24px;
        box-shadow: 0 18px 40px rgba(0,0,0,0.12);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
    }
    .top-navbar .nav-left{
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .top-navbar .brand-title{
        font-size: 1.2rem;
        font-weight: 800;
        letter-spacing: 0.5px;
    }
    .top-navbar .hamburger-btn{
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 4px;
        border-radius: 0;
        transition: none;
        display: flex;
        flex-direction: column;
        gap: 4px;
        appearance: none;
    }
    .top-navbar .hamburger-btn:hover{
        background: transparent;
    }
    .top-navbar .hamburger-btn:focus{
        outline: none;
        box-shadow: none;
    }
    .top-navbar .hamburger-line{
        width: 24px;
        height: 3px;
        background: #fff;
        border-radius: 2px;
        transition: all 0.3s;
    }
    .top-navbar .hamburger-btn.active .hamburger-line:nth-child(1){
        transform: rotate(45deg) translate(6px, 6px);
    }
    .top-navbar .hamburger-btn.active .hamburger-line:nth-child(2){
        opacity: 0;
    }
    .top-navbar .hamburger-btn.active .hamburger-line:nth-child(3){
        transform: rotate(-45deg) translate(6px, -6px);
    }
    .top-navbar .nav-actions{
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .top-navbar .navbar-text{
        color: rgba(255,255,255,0.95);
        font-weight: 700;
    }
    .top-navbar .btn-profile,
    .top-navbar .btn-logout{
        min-width: 100px;
        white-space: nowrap;
        border-radius: 999px;
        padding: 10px 18px;
        font-weight: 700;
    }
    .top-navbar .btn-profile{
        background: rgba(255,255,255,0.16);
        color: #fff;
        border: 1px solid rgba(255,255,255,0.28);
    }
    .top-navbar .btn-profile:hover{
        background: rgba(255,255,255,0.26);
    }
    .top-navbar .btn-logout{
        background: #dc3545;
        color: #fff;
        border: 1px solid #c82333;
    }
    .top-navbar .btn-logout:hover{
        background: #bd2130;
        border-color: #a71d2a;
    }
    @media (max-width: 768px){
        .top-navbar .hamburger-btn{display: none;}
        .top-navbar .nav-left{gap: 0;}
    }

    /* Header */
    .header{display:flex; align-items:center; justify-content:space-between; gap:16px; padding:10px 0 18px;}
    @media (max-width: 768px){
        .header{padding-left:14px; padding-right:14px;}
        .main{padding-left:14px; padding-right:14px;}
    }

    .logo{font-size:20px; font-weight:800; background:linear-gradient(135deg, var(--primary), var(--primary2)); -webkit-background-clip:text; background-clip:text; color:transparent;}

    .profil{display:flex; align-items:center; gap:14px;}
    .profil .user-name{font-weight:800; color:var(--text);}

    /* Cards */
    .card{
        background:white;
        border-radius:8px;
        box-shadow:0 2px 4px rgba(0,0,0,0.05);
        border:1px solid rgba(0,0,0,0.08);
        transition:all .3s ease;
        margin-bottom:20px;
    }
    .card:hover{box-shadow:0 4px 8px rgba(0,0,0,0.1); transform:translateY(-2px);}

    .card-stat{
        background:linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
        color:white;
        border:none;
        border-radius:8px;
        box-shadow:0 4px 15px rgba(33,150,243,.3);
        transition:transform .15s ease;
    }
    .card-stat:hover{transform:translateY(-2px);}

    .section-title{
        font-size:1.2rem;
        font-weight:600;
        margin-top:30px;
        margin-bottom:15px;
        padding-bottom:10px;
        border-bottom:2px solid #4A90E2;
        color:#1976D2;
    }


    /* Buttons */
    .btn-primary{
        background:linear-gradient(135deg, var(--primary), var(--primary2));
        border:none;
        color:#fff;
    }
    .btn-primary:hover{filter:brightness(.95);}

    .btn-secondary{background:#111827; border:none;}

    /* Alerts */
    .alert{border-radius:12px;}

    /* Logout btn */
    .logout-btn{background:transparent; border:1px solid var(--border); border-radius:12px; padding:8px 12px; font-weight:700;}
    .logout-btn:hover{background:rgba(255,255,255,.65);}

    /* Profile container */
    .profile-container{
        background:#fff;
        border:1px solid var(--border);
        border-radius:18px;
        padding:18px;
        box-shadow:0 10px 30px rgba(17,24,39,.05);
    }
    .profile-header h2{margin:0 0 10px; font-weight:900;}

    .form-row{display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-top:12px;}
    @media (max-width: 768px){.form-row{grid-template-columns:1fr;}}
    .form-group label{display:block; font-weight:800; margin-bottom:6px; color:var(--muted);}
    .form-group input,.form-group select{width:100%;}

    .btn-container{display:flex; gap:12px; align-items:center; margin-top:16px; justify-content:flex-end;}

</style>
<script>
    // Sidebar close button safety: add/remove class 'closed' and 'show'
    document.addEventListener('DOMContentLoaded', function(){
        const sidebar = document.getElementById('sidebar');
        const hamburgerBtn = document.getElementById('hamburger-btn');

        if(!sidebar) return;

        // Hamburger button toggle
        if(hamburgerBtn){
            hamburgerBtn.addEventListener('click', function(){
                sidebar.classList.toggle('closed');
                hamburgerBtn.classList.toggle('active');
            });
        }

        // Close sidebar when clicking outside (optional)
        document.addEventListener('click', function(event){
            if(!sidebar.contains(event.target) && !hamburgerBtn.contains(event.target)){
                sidebar.classList.add('closed');
                hamburgerBtn.classList.remove('active');
            }
        });

        const closeBtn = sidebar.querySelector('.close-btn');
        if(closeBtn){
            closeBtn.addEventListener('click', function(){
                sidebar.classList.add('closed');
                hamburgerBtn.classList.remove('active');
            });
        }
    });
</script>

