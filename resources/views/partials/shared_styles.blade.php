<style>
    /* Shared minimal overrides (keep using resources/css/style.css as source of truth) */
    .main{margin-left:250px; padding:20px; width:calc(100% - 250px); min-height:100vh; transition:margin-left .3s ease,width .3s ease;}
    @media (max-width:768px){.main{margin-left:0; width:100%;}}

    /* Sidebar + header + card-stat styling only if not covered */



    /* Sidebar */
    .sidebar{
        position:fixed;
        top:0; left:0;
        height:100vh;
        width:270px;
        background:linear-gradient(180deg, rgba(102,126,234,.14), rgba(118,75,162,.14));
        border-right:1px solid var(--border);
        padding:18px 14px;
        overflow:auto;
        transition:transform .25s ease;
        z-index:1000;
    }
    .sidebar.closed{transform:translateX(-100%);}
    .sidebar h3{font-size:16px; margin:0 0 14px; display:flex; align-items:center; justify-content:space-between;}
    .sidebar a{
        display:block;
        padding:10px 10px;
        border-radius:10px;
        color:var(--text);
        text-decoration:none;
        border:1px solid transparent;
        margin-bottom:5px;
        font-weight:600;
        background:rgba(255,255,255,.35);
    }
    .sidebar a:hover{background:rgba(255,255,255,.75); border-color:var(--border);}
    .sidebar a.active{background:linear-gradient(135deg, var(--primary), var(--primary2)); color:#fff;}

    .submenu{margin-top:10px;}
    .submenu-items a{margin-bottom:5px; font-weight:600;}

    /* Header */
    .header{display:flex; align-items:center; justify-content:space-between; gap:16px; padding:8px 0 18px; margin-left:270px;}
    @media (max-width: 768px){
        .header{margin-left:0; padding-left:14px; padding-right:14px;}
        .main{padding-left:14px; padding-right:14px;}
    }

    /* Hamburger Button */
    .hamburger-btn{
        display:none;
        flex-direction:column;
        justify-content:center;
        align-items:center;
        width:40px;
        height:40px;
        background:transparent;
        border:none;
        cursor:pointer;
        padding:8px;
        border-radius:8px;
        transition:background-color 0.3s ease;
    }
    .hamburger-btn:hover{background-color:rgba(255,255,255,0.1);}
    .hamburger-line{
        width:25px;
        height:3px;
        background-color:#fff;
        margin:3px 0;
        transition:0.3s;
        border-radius:2px;
    }
    .hamburger-btn.active .hamburger-line:nth-child(1){transform:rotate(-45deg) translate(-5px, 6px);}
    .hamburger-btn.active .hamburger-line:nth-child(2){opacity:0;}
    .hamburger-btn.active .hamburger-line:nth-child(3){transform:rotate(45deg) translate(-5px, -6px);}

    @media (max-width:768px){
        .hamburger-btn{display:flex;}
        .sidebar{transform:translateX(-100%);}
        .sidebar.open{transform:translateX(0);}
    }
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
        if(!sidebar) return;

        const closeBtn = sidebar.querySelector('.close-btn');
        if(closeBtn){
            closeBtn.addEventListener('click', function(){
                sidebar.classList.add('closed');
            });
        }
    });
</script>