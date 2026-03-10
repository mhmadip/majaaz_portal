<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>بوابة مسابقة مجاز المعمارية ٢٠٢٦</title>
<link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;600;700&family=Amiri:wght@400;700&family=IBM+Plex+Mono&display=swap" rel="stylesheet">
<style>
:root{
  --cyan:#00e5cc;--cyan-dim:#00b8a4;--cyan-glow:rgba(0,229,204,0.15);
  --dark:#070a0e;--dark2:#0d1117;--dark3:#131920;--dark4:#1a2330;
  --border:rgba(0,229,204,0.18);--border-subtle:rgba(255,255,255,0.06);
  --text:#e8edf2;--text-dim:#8a9bb0;--gold:#c9a84c;
}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Noto Naskh Arabic',serif;background:var(--dark);color:var(--text);min-height:100vh;overflow-x:hidden;}
body::before{content:'';position:fixed;inset:0;background:radial-gradient(ellipse 80% 50% at 20% 20%,rgba(0,229,204,0.04),transparent 60%),repeating-linear-gradient(0deg,transparent,transparent 59px,rgba(0,229,204,0.02) 60px),repeating-linear-gradient(90deg,transparent,transparent 59px,rgba(0,229,204,0.02) 60px);pointer-events:none;z-index:0;}
.view{display:none;position:relative;z-index:1;min-height:100vh;}.view.active{display:block;}

.btn{padding:10px 22px;border-radius:8px;border:none;cursor:pointer;font-family:'Noto Naskh Arabic',serif;font-size:14px;font-weight:600;transition:all .25s;display:inline-flex;align-items:center;gap:8px;}
.btn-outline{background:transparent;border:1px solid var(--border);color:var(--text-dim);}
.btn-outline:hover{border-color:var(--cyan);color:var(--cyan);background:var(--cyan-glow);}
.btn-primary{background:var(--cyan);color:var(--dark);font-weight:700;}
.btn-primary:hover{background:var(--cyan-dim);box-shadow:0 0 20px rgba(0,229,204,0.4);transform:translateY(-1px);}
.btn-ghost{background:transparent;color:var(--text-dim);padding:8px 16px;}
.btn-ghost:hover{color:var(--text);}
.btn-danger{background:rgba(255,80,80,0.1);border:1px solid rgba(255,80,80,0.3);color:#ff6b6b;}
.btn-danger:hover{background:rgba(255,80,80,0.2);}
.btn-save{background:rgba(0,229,204,0.12);border:1px solid var(--border);color:var(--cyan);font-weight:700;}
.btn-save:hover{background:rgba(0,229,204,0.22);}
.form-group{margin-bottom:20px;}
.form-label{display:block;font-size:13px;color:var(--text-dim);margin-bottom:8px;font-weight:600;}
.form-input{width:100%;background:var(--dark3);border:1px solid var(--border-subtle);border-radius:10px;padding:12px 16px;color:var(--text);font-family:'Noto Naskh Arabic',serif;font-size:14px;transition:border-color .2s,box-shadow .2s;outline:none;}
.form-input:focus{border-color:var(--cyan);box-shadow:0 0 0 3px rgba(0,229,204,0.1);}
.form-input::placeholder{color:var(--text-dim);opacity:.5;}
.panel{background:var(--dark2);border:1px solid var(--border-subtle);border-radius:16px;padding:28px;margin-bottom:24px;}
.panel-title{font-family:'Amiri',serif;font-size:18px;margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid var(--border-subtle);display:flex;align-items:center;gap:10px;}
.panel-title::before{content:'';width:3px;height:20px;background:var(--cyan);border-radius:2px;flex-shrink:0;}
.badge{padding:4px 10px;border-radius:20px;font-size:11px;font-weight:600;font-family:'IBM Plex Mono',monospace;}
.badge-success{background:rgba(0,229,100,0.12);color:#00e564;border:1px solid rgba(0,229,100,0.25);}
.badge-pending{background:rgba(255,200,50,0.12);color:#ffc832;border:1px solid rgba(255,200,50,0.25);}
.badge-saved{background:rgba(100,150,255,0.12);color:#6496ff;border:1px solid rgba(100,150,255,0.25);}
.empty-state{text-align:center;padding:60px 40px;color:var(--text-dim);}
.empty-icon{font-size:48px;margin-bottom:16px;opacity:.3;display:block;}
.fade-in{animation:fadeIn .4s ease forwards;}
@keyframes fadeIn{from{opacity:0;transform:translateY(12px)}to{opacity:1;transform:translateY(0)}}
::-webkit-scrollbar{width:6px;height:6px;}
::-webkit-scrollbar-track{background:var(--dark);}
::-webkit-scrollbar-thumb{background:var(--border);border-radius:3px;}
::-webkit-scrollbar-thumb:hover{background:var(--cyan-dim);}

/* header */
.pub-header{display:flex;align-items:center;justify-content:space-between;padding:20px 48px;border-bottom:1px solid var(--border);backdrop-filter:blur(10px);background:rgba(7,10,14,0.9);position:sticky;top:0;z-index:100;}
.logo-wrap{display:flex;align-items:center;gap:14px;cursor:pointer;}
.logo-mark{background:var(--dark2);border:1px solid var(--cyan);border-radius:10px;width:44px;height:44px;display:flex;align-items:center;justify-content:center;font-family:'Amiri',serif;font-size:20px;color:var(--cyan);box-shadow:0 0 16px rgba(0,229,204,0.25);}
.logo-title{font-family:'Amiri',serif;font-size:20px;font-weight:700;}
.logo-sub{font-family:'IBM Plex Mono',monospace;font-size:10px;color:var(--cyan);letter-spacing:.15em;text-transform:uppercase;}

/* hero */
.hero{padding:70px 48px 50px;text-align:center;}
.hero-eyebrow{font-family:'IBM Plex Mono',monospace;font-size:11px;color:var(--cyan);letter-spacing:.2em;text-transform:uppercase;margin-bottom:16px;}
.hero-title{font-family:'Amiri',serif;font-size:clamp(30px,5vw,56px);font-weight:700;line-height:1.2;margin-bottom:14px;background:linear-gradient(135deg,#fff 0%,var(--cyan) 50%,var(--gold) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;}
.hero-sub{color:var(--text-dim);font-size:15px;max-width:500px;margin:0 auto 36px;line-height:1.7;}
.hero-stats{display:flex;justify-content:center;gap:48px;margin-bottom:50px;}
.stat-num{font-family:'IBM Plex Mono',monospace;font-size:30px;color:var(--cyan);font-weight:700;display:block;line-height:1;margin-bottom:5px;}
.stat-label{font-size:12px;color:var(--text-dim);}
.projects-section{padding:0 48px 80px;}
.section-title{font-family:'Amiri',serif;font-size:22px;display:flex;align-items:center;gap:12px;margin-bottom:28px;}
.section-title::before{content:'';width:4px;height:24px;background:var(--cyan);border-radius:2px;display:inline-block;}
.pub-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:24px;}

/* public card */
.pub-card{background:var(--dark2);border:1px solid var(--border-subtle);border-radius:16px;overflow:hidden;cursor:pointer;transition:all .35s ease;position:relative;}
.pub-card:hover{border-color:var(--border);transform:translateY(-5px);box-shadow:0 24px 60px rgba(0,0,0,0.5),0 0 30px rgba(0,229,204,0.07);}
.pub-card-img-wrap{overflow:hidden;position:relative;}
.pub-card-cover{width:100%;height:220px;object-fit:cover;display:block;transition:transform .5s ease;}
.pub-card:hover .pub-card-cover{transform:scale(1.04);}
.pub-card-cover-ph{width:100%;height:220px;background:linear-gradient(135deg,var(--dark3),var(--dark4));display:flex;flex-direction:column;align-items:center;justify-content:center;gap:10px;font-size:44px;}
.img-count-badge{position:absolute;bottom:10px;left:10px;background:rgba(7,10,14,0.82);backdrop-filter:blur(6px);border:1px solid var(--border);border-radius:20px;padding:4px 10px;font-family:'IBM Plex Mono',monospace;font-size:11px;color:var(--cyan);}
.pub-card-arrow{position:absolute;top:50%;right:50%;transform:translate(50%,-50%);width:50px;height:50px;border-radius:50%;background:rgba(0,229,204,0.9);display:flex;align-items:center;justify-content:center;font-size:20px;opacity:0;transition:opacity .3s ease;}
.pub-card:hover .pub-card-arrow{opacity:1;}
.pub-card-body{padding:18px 20px;}
.pub-card-name{font-family:'Amiri',serif;font-size:19px;font-weight:700;margin-bottom:10px;}
.pub-card-meta{display:flex;justify-content:space-between;align-items:center;font-size:12px;color:var(--text-dim);}

/* detail view */
#view-project-detail{background:var(--dark);}
.detail-header{display:flex;align-items:center;justify-content:space-between;padding:20px 48px;border-bottom:1px solid var(--border);background:rgba(7,10,14,0.9);backdrop-filter:blur(10px);position:sticky;top:0;z-index:100;}
.detail-back{display:flex;align-items:center;gap:8px;color:var(--cyan);cursor:pointer;font-weight:600;font-size:14px;transition:opacity .2s;}
.detail-back:hover{opacity:.75;}
.detail-hero{position:relative;height:420px;overflow:hidden;cursor:pointer;}
.detail-hero-img{width:100%;height:100%;object-fit:cover;transition:transform .4s ease;}
.detail-hero:hover .detail-hero-img{transform:scale(1.02);}
.detail-hero-ph{width:100%;height:100%;background:linear-gradient(135deg,var(--dark3),var(--dark4));display:flex;align-items:center;justify-content:center;font-size:80px;opacity:.2;}
.detail-hero-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(7,10,14,1) 0%,rgba(7,10,14,0.35) 50%,transparent 100%);pointer-events:none;}
.detail-hero-title{position:absolute;bottom:32px;right:48px;left:48px;pointer-events:none;}
.detail-hero-title h1{font-family:'Amiri',serif;font-size:clamp(24px,4vw,42px);font-weight:700;line-height:1.2;margin-bottom:10px;}
.detail-body{padding:40px 48px 80px;}
.gallery-label{font-family:'Amiri',serif;font-size:20px;display:flex;align-items:center;gap:10px;margin-bottom:20px;}
.gallery-label::before{content:'';width:3px;height:22px;background:var(--cyan);border-radius:2px;display:inline-block;}

/* gallery grid with description */
.gallery-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:16px;}
.gallery-item{background:var(--dark2);border:1px solid var(--border-subtle);border-radius:12px;overflow:hidden;cursor:pointer;transition:all .3s;}
.gallery-item:hover{border-color:var(--cyan);transform:translateY(-3px);box-shadow:0 12px 40px rgba(0,0,0,0.4);}
.gallery-item-img{width:100%;height:170px;object-fit:cover;display:block;}
.gallery-item-desc{padding:10px 12px;font-size:13px;color:var(--text-dim);line-height:1.5;border-top:1px solid var(--border-subtle);display:flex;align-items:flex-start;gap:8px;}
.gallery-item-desc.empty{display:none;}
.gallery-item-desc-icon{color:var(--cyan);flex-shrink:0;margin-top:1px;}
.gallery-item-num{position:absolute;top:8px;right:8px;background:rgba(7,10,14,0.75);backdrop-filter:blur(4px);border:1px solid var(--border);border-radius:12px;padding:2px 8px;font-family:'IBM Plex Mono',monospace;font-size:10px;color:var(--cyan);}

/* evaluations on detail */
.evals-section{margin-bottom:48px;}
.eval-card{background:var(--dark2);border:1px solid var(--border-subtle);border-radius:14px;padding:20px;margin-bottom:14px;}
.eval-card-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;padding-bottom:12px;border-bottom:1px solid var(--border-subtle);}
.eval-juror{font-family:'Amiri',serif;font-size:17px;font-weight:700;}
.eval-scores-wrap{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:12px;}
.eval-crit-row{background:var(--dark3);border-radius:8px;padding:10px 12px;display:flex;justify-content:space-between;align-items:center;font-size:12px;}
.eval-crit-text{color:var(--text-dim);flex:1;line-height:1.4;}
.eval-crit-score{font-family:'IBM Plex Mono',monospace;color:var(--cyan);font-weight:700;font-size:14px;margin-right:10px;white-space:nowrap;}
.eval-score-bar{height:4px;background:var(--dark4);border-radius:2px;overflow:hidden;margin-top:5px;}
.eval-score-fill{height:100%;background:linear-gradient(90deg,var(--cyan-dim),var(--cyan));border-radius:2px;}
.eval-total{font-family:'IBM Plex Mono',monospace;font-size:26px;color:var(--cyan);font-weight:700;line-height:1;}
.eval-norm{font-size:12px;color:var(--gold);font-family:'IBM Plex Mono',monospace;}
.eval-comment-block{background:var(--dark3);border-radius:10px;padding:14px;border-right:3px solid var(--cyan);font-size:13px;color:var(--text-dim);font-style:italic;line-height:1.7;}
.no-evals{text-align:center;padding:40px;background:var(--dark2);border-radius:14px;border:1px dashed var(--border-subtle);color:var(--text-dim);}

/* ── LIGHTBOX (upgraded with description) ── */
.lightbox{position:fixed;inset:0;background:rgba(0,0,0,0.96);z-index:300;display:none;flex-direction:column;}
.lightbox.open{display:flex;}
.lb-topbar{display:flex;align-items:center;justify-content:space-between;padding:14px 20px;flex-shrink:0;}
.lb-topbar-title{font-family:'Amiri',serif;font-size:16px;color:var(--text);}
.lb-close{width:36px;height:36px;border-radius:50%;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);color:#fff;font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;flex-shrink:0;}
.lb-close:hover{background:rgba(255,255,255,0.2);}
.lb-counter-top{font-family:'IBM Plex Mono',monospace;font-size:12px;color:rgba(255,255,255,0.45);}
.lb-main{display:flex;flex:1;min-height:0;position:relative;}
.lb-img-area{flex:1;display:flex;align-items:center;justify-content:center;padding:10px;position:relative;}
.lb-img{max-width:100%;max-height:100%;object-fit:contain;border-radius:8px;box-shadow:0 20px 80px rgba(0,0,0,0.8);display:block;}
.lb-nav-btn{position:absolute;top:50%;transform:translateY(-50%);width:44px;height:44px;border-radius:50%;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.15);color:#fff;font-size:18px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .2s;z-index:2;}
.lb-nav-btn:hover{background:rgba(255,255,255,0.2);}
.lb-prev{right:12px;}
.lb-next{left:12px;}
/* description panel */
.lb-desc-panel{width:280px;background:rgba(13,17,23,0.95);border-right:1px solid var(--border-subtle);display:flex;flex-direction:column;flex-shrink:0;overflow-y:auto;}
.lb-desc-inner{padding:20px;flex:1;}
.lb-desc-label{font-size:11px;color:var(--cyan);font-family:'IBM Plex Mono',monospace;letter-spacing:.1em;text-transform:uppercase;margin-bottom:10px;}
.lb-desc-text{font-size:14px;color:var(--text);line-height:1.75;}
.lb-desc-empty{font-size:13px;color:var(--text-dim);font-style:italic;opacity:.6;}
.lb-thumb-strip{display:flex;gap:6px;padding:10px 14px;background:rgba(7,10,14,0.8);border-top:1px solid var(--border-subtle);overflow-x:auto;flex-shrink:0;}
.lb-thumb{width:52px;height:52px;object-fit:cover;border-radius:6px;cursor:pointer;border:2px solid transparent;transition:all .2s;flex-shrink:0;opacity:.6;}
.lb-thumb.active{border-color:var(--cyan);opacity:1;}
.lb-thumb:hover{opacity:.9;}

/* auth */
#view-auth{display:flex;align-items:center;justify-content:center;min-height:100vh;padding:40px 20px;}
.auth-card{background:var(--dark2);border:1px solid var(--border);border-radius:20px;padding:48px;width:100%;max-width:420px;position:relative;overflow:hidden;box-shadow:0 40px 80px rgba(0,0,0,0.5);}
.auth-card::before{content:'';position:absolute;top:-1px;right:10%;left:10%;height:1px;background:linear-gradient(90deg,transparent,var(--cyan),transparent);}
.auth-tabs{display:flex;gap:8px;margin-bottom:32px;background:var(--dark3);border-radius:12px;padding:4px;}
.auth-tab{flex:1;padding:9px;border-radius:9px;border:none;background:transparent;color:var(--text-dim);cursor:pointer;font-family:'Noto Naskh Arabic',serif;font-size:13px;font-weight:600;transition:all .2s;}
.auth-tab.active{background:var(--dark2);color:var(--cyan);box-shadow:0 2px 8px rgba(0,0,0,0.3);}
.auth-error{background:rgba(255,80,80,0.1);border:1px solid rgba(255,80,80,0.3);color:#ff8080;border-radius:8px;padding:10px 14px;font-size:13px;margin-bottom:16px;display:none;}
.auth-error.show{display:block;}

/* dashboard */
.dashboard{display:flex;min-height:100vh;}
.sidebar{width:260px;background:var(--dark2);border-left:1px solid var(--border-subtle);padding:28px 0;display:flex;flex-direction:column;position:fixed;top:0;right:0;bottom:0;z-index:50;overflow-y:auto;}
.sidebar-logo{padding:0 24px 24px;border-bottom:1px solid var(--border-subtle);margin-bottom:12px;}
.nav-item{display:flex;align-items:center;gap:12px;padding:12px 24px;color:var(--text-dim);cursor:pointer;border:none;background:transparent;width:100%;text-align:right;font-family:'Noto Naskh Arabic',serif;font-size:14px;font-weight:600;transition:all .2s;border-right:3px solid transparent;}
.nav-item:hover{color:var(--text);background:rgba(255,255,255,0.03);}
.nav-item.active{color:var(--cyan);background:var(--cyan-glow);border-right-color:var(--cyan);}
.sidebar-footer{margin-top:auto;padding:20px 24px;border-top:1px solid var(--border-subtle);}
.user-chip{display:flex;align-items:center;gap:10px;padding:10px 12px;background:var(--dark3);border-radius:10px;margin-bottom:12px;}
.user-avatar{width:32px;height:32px;background:var(--cyan-glow);border:1px solid var(--border);border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:14px;color:var(--cyan);font-weight:700;font-family:'IBM Plex Mono',monospace;flex-shrink:0;}
.user-name{font-size:13px;font-weight:600;line-height:1.2;}
.user-role{font-size:11px;color:var(--cyan);}
.main-content{flex:1;margin-right:260px;padding:40px;min-height:100vh;}
.page-title{font-family:'Amiri',serif;font-size:26px;margin-bottom:4px;display:flex;align-items:center;gap:12px;}
.page-sub{font-size:14px;color:var(--text-dim);margin-bottom:32px;}
.dash-section{display:none;}.dash-section.active{display:block;}
.stats-row{display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:16px;margin-bottom:28px;}
.stat-card{background:var(--dark3);border:1px solid var(--border-subtle);border-radius:12px;padding:20px;}
.stat-card-num{font-family:'IBM Plex Mono',monospace;font-size:30px;font-weight:700;color:var(--cyan);line-height:1;margin-bottom:5px;}
.stat-card-label{font-size:12px;color:var(--text-dim);}
.data-table{width:100%;border-collapse:collapse;}
.data-table th{text-align:right;font-size:11px;color:var(--text-dim);font-weight:600;padding:10px 16px;border-bottom:1px solid var(--border-subtle);letter-spacing:.04em;font-family:'IBM Plex Mono',monospace;text-transform:uppercase;}
.data-table td{padding:13px 16px;font-size:14px;border-bottom:1px solid var(--border-subtle);vertical-align:middle;}
.data-table tr:last-child td{border-bottom:none;}
.data-table tr:hover td{background:rgba(255,255,255,0.02);}
.tag{display:inline-block;padding:3px 8px;border-radius:6px;font-size:11px;font-family:'IBM Plex Mono',monospace;}
.tag-jury{background:rgba(201,168,76,0.15);color:var(--gold);border:1px solid rgba(201,168,76,0.3);}
.tag-admin{background:rgba(200,100,255,0.12);color:#cc80ff;border:1px solid rgba(200,100,255,0.3);}
.projects-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:18px;}
.proj-card{background:var(--dark3);border:1px solid var(--border-subtle);border-radius:14px;overflow:hidden;transition:all .3s;}
.proj-card:hover{border-color:var(--border);box-shadow:0 12px 40px rgba(0,0,0,0.3);}
.proj-card-cover{width:100%;height:150px;object-fit:cover;}
.proj-card-cover-ph{width:100%;height:150px;background:linear-gradient(135deg,var(--dark3),var(--dark4));display:flex;align-items:center;justify-content:center;font-size:36px;}
.proj-card-body{padding:14px;}
.proj-card-name{font-family:'Amiri',serif;font-size:15px;font-weight:700;margin-bottom:6px;}
.proj-card-meta{font-size:12px;color:var(--text-dim);display:flex;justify-content:space-between;align-items:center;}
.proj-card-actions{display:flex;gap:8px;margin-top:10px;}

/* upload zones */
.upload-zone{border:2px dashed var(--border);border-radius:12px;padding:24px;text-align:center;cursor:pointer;transition:all .2s;margin-bottom:12px;}
.upload-zone:hover{border-color:var(--cyan);background:var(--cyan-glow);}
.upload-zone-icon{font-size:26px;margin-bottom:8px;opacity:.5;}
.upload-zone-text{font-size:13px;color:var(--text-dim);}
.upload-zone-sub{font-size:11px;color:var(--text-dim);opacity:.5;margin-top:4px;}

/* image items in admin upload — with description field */
.img-items-list{display:flex;flex-direction:column;gap:10px;margin-top:10px;}
.img-item{display:flex;gap:12px;align-items:flex-start;background:var(--dark3);border:1px solid var(--border-subtle);border-radius:10px;padding:10px;}
.img-item-thumb{width:70px;height:70px;object-fit:cover;border-radius:8px;flex-shrink:0;border:1px solid var(--border-subtle);}
.img-item-body{flex:1;min-width:0;}
.img-item-name{font-size:12px;color:var(--cyan);margin-bottom:6px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}
.img-item-desc-input{width:100%;background:var(--dark4);border:1px solid var(--border-subtle);border-radius:8px;padding:8px 10px;color:var(--text);font-family:'Noto Naskh Arabic',serif;font-size:12px;outline:none;transition:border-color .2s;resize:none;}
.img-item-desc-input:focus{border-color:var(--cyan);}
.img-item-remove{width:24px;height:24px;border-radius:6px;background:rgba(255,80,80,0.1);border:1px solid rgba(255,80,80,0.3);color:#ff6b6b;cursor:pointer;font-size:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .2s;}
.img-item-remove:hover{background:rgba(255,80,80,0.25);}
.multi-count{font-size:12px;color:var(--text-dim);margin-top:6px;}

/* likert */
.likert-group{margin-bottom:12px;background:var(--dark3);border:1px solid var(--border-subtle);border-radius:12px;padding:14px;}
.likert-q{font-size:13px;font-weight:600;color:var(--text);margin-bottom:10px;line-height:1.5;}
.likert-q span{font-family:'IBM Plex Mono',monospace;color:var(--cyan);margin-left:6px;font-size:12px;}
.likert-scale{display:flex;gap:5px;flex-wrap:wrap;}
.likert-btn{flex:1;min-width:75px;padding:8px 4px;border-radius:8px;border:1px solid var(--border-subtle);background:var(--dark4);color:var(--text-dim);cursor:pointer;font-family:'Noto Naskh Arabic',serif;font-size:11px;font-weight:600;transition:all .2s;text-align:center;line-height:1.3;}
.likert-btn:hover{border-color:var(--cyan);color:var(--cyan);background:var(--cyan-glow);}
.likert-btn.selected{background:var(--cyan);border-color:var(--cyan);color:var(--dark);}
.likert-btn .lk-val{display:block;font-family:'IBM Plex Mono',monospace;font-size:14px;font-weight:700;margin-bottom:2px;}
.score-display{font-family:'IBM Plex Mono',monospace;font-size:26px;color:var(--cyan);font-weight:700;text-align:center;padding:14px;background:var(--dark3);border-radius:12px;border:1px solid var(--border);margin-bottom:16px;}
.score-display small{font-size:12px;color:var(--text-dim);display:block;margin-top:3px;font-family:'Noto Naskh Arabic',serif;}
.score-display .norm{font-size:13px;color:var(--gold);display:block;margin-top:2px;font-family:'IBM Plex Mono',monospace;}
.eval-progress{background:var(--dark3);border-radius:10px;padding:10px 14px;margin-bottom:14px;display:flex;align-items:center;gap:12px;}
.eval-progress-bar{flex:1;height:5px;background:var(--dark4);border-radius:3px;overflow:hidden;}
.eval-progress-fill{height:100%;background:linear-gradient(90deg,var(--cyan-dim),var(--cyan));border-radius:3px;transition:width .4s ease;}
.eval-progress-text{font-family:'IBM Plex Mono',monospace;font-size:11px;color:var(--cyan);white-space:nowrap;}

/* jury proj card */
.jury-proj-card{background:var(--dark3);border:1px solid var(--border-subtle);border-radius:14px;overflow:hidden;cursor:pointer;transition:all .3s;}
.jury-proj-card:hover{border-color:var(--border);transform:translateY(-3px);box-shadow:0 12px 40px rgba(0,0,0,0.3);}

/* modal */
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,0.78);backdrop-filter:blur(6px);z-index:200;display:none;align-items:center;justify-content:center;padding:20px;}
.modal-overlay.open{display:flex;}
.modal{background:var(--dark2);border:1px solid var(--border);border-radius:20px;padding:32px;width:100%;max-width:660px;max-height:92vh;overflow-y:auto;position:relative;box-shadow:0 40px 80px rgba(0,0,0,0.6);animation:modalIn .3s cubic-bezier(.34,1.56,.64,1);}
@keyframes modalIn{from{opacity:0;transform:scale(.92) translateY(20px)}to{opacity:1;transform:scale(1) translateY(0)}}
.modal-title{font-family:'Amiri',serif;font-size:20px;margin-bottom:20px;padding-bottom:14px;border-bottom:1px solid var(--border-subtle);display:flex;align-items:center;gap:10px;}
.modal-close{position:absolute;top:18px;left:18px;width:30px;height:30px;border-radius:8px;border:1px solid var(--border-subtle);background:var(--dark3);color:var(--text-dim);cursor:pointer;font-size:14px;display:flex;align-items:center;justify-content:center;transition:all .2s;}
.modal-close:hover{border-color:var(--cyan);color:var(--cyan);}
.modal-actions{display:flex;gap:10px;margin-top:20px;}
.modal-actions .btn{flex:1;justify-content:center;padding:13px;}

/* toast */
.toast-container{position:fixed;bottom:28px;left:50%;transform:translateX(-50%);z-index:500;display:flex;flex-direction:column;gap:8px;pointer-events:none;}
.toast{background:var(--dark2);border:1px solid var(--border);color:var(--text);padding:11px 18px;border-radius:12px;font-size:14px;box-shadow:0 8px 32px rgba(0,0,0,0.4);animation:toastIn .3s ease;display:flex;align-items:center;gap:8px;}
.toast.success{border-color:rgba(0,229,100,0.4);}
.toast.error{border-color:rgba(255,80,80,0.4);}
@keyframes toastIn{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}

@media(max-width:768px){
  .pub-header,.detail-header{padding:16px 20px;}
  .hero{padding:40px 20px 30px;}
  .projects-section,.detail-body{padding:0 20px 40px;}
  .hero-stats{gap:24px;}
  .sidebar{width:100%;position:relative;height:auto;}
  .main-content{margin-right:0;padding:20px;}
  .detail-hero{height:260px;}
  .detail-hero-title{right:20px;left:20px;bottom:20px;}
  .eval-scores-wrap{grid-template-columns:1fr;}
  .likert-scale{flex-direction:column;}
  .lb-desc-panel{width:100%;max-height:160px;border-right:none;border-top:1px solid var(--border-subtle);}
  .lb-main{flex-direction:column;}
}
</style>
</head>
<body>

<!-- PUBLIC LIST -->
<div id="view-public" class="view active">
  <header class="pub-header">
    <div class="logo-wrap" id="logo-home">
      <div class="logo-mark">م</div>
      <div><div class="logo-title">مجاز</div><div class="logo-sub">MAJAAZ · 2026</div></div>
    </div>
    <button class="btn btn-outline" id="btn-go-auth">🔐 دخول المحكّمين والإدارة</button>
  </header>
  <section class="hero">
    <div class="hero-eyebrow">مسابقة معمارية · العراق ٢٠٢٦</div>
    <h1 class="hero-title">بوابة تقييم مسابقة<br>مجاز المعمارية</h1>
    <p class="hero-sub">استعرض جميع المشاريع — انقر على أي مشروع لرؤية الصور والتقييمات</p>
    <div class="hero-stats">
      <div class="stat"><span class="stat-num" id="pub-total">0</span><div class="stat-label">مشروع مشارك</div></div>
      <div class="stat"><span class="stat-num" id="pub-evaluated">0</span><div class="stat-label">مشروع مُقيَّم</div></div>
      <div class="stat"><span class="stat-num" id="pub-evals-count">0</span><div class="stat-label">تقييم منشور</div></div>
    </div>
  </section>
  <section class="projects-section">
    <div class="section-title">جميع المشاريع</div>
    <div id="pub-grid" class="pub-grid"></div>
    <div id="pub-empty" class="empty-state" style="display:none;"><span class="empty-icon">🏛</span><p>لم تُضف مشاريع بعد</p></div>
  </section>
</div>

<!-- PROJECT DETAIL -->
<div id="view-project-detail" class="view">
  <header class="detail-header">
    <div class="logo-wrap" id="detail-logo-home">
      <div class="logo-mark">م</div>
      <div><div class="logo-title">مجاز</div><div class="logo-sub">MAJAAZ · 2026</div></div>
    </div>
    <div class="detail-back" id="detail-back">← العودة للمشاريع</div>
  </header>
  <div id="detail-content"></div>
</div>

<!-- AUTH -->
<div id="view-auth" class="view">
  <div style="position:fixed;top:20px;right:20px;z-index:100;">
    <button class="btn btn-ghost" id="btn-back-public">← العودة للعرض العام</button>
  </div>
  <div style="display:flex;align-items:center;justify-content:center;min-height:100vh;padding:40px 20px;">
    <div class="auth-card fade-in">
      <div style="text-align:center;margin-bottom:32px;">
        <div class="logo-mark" style="width:60px;height:60px;font-size:26px;margin:0 auto 12px;">م</div>
        <div style="font-family:'Amiri',serif;font-size:22px;margin-bottom:4px;">مجاز ٢٠٢٦</div>
        <div style="font-family:'IBM Plex Mono',monospace;font-size:10px;color:var(--cyan);letter-spacing:.15em;">MAJAAZ ARCHITECTURAL COMPETITION</div>
      </div>
      <div class="auth-tabs">
        <button class="auth-tab active" id="tab-admin">إدارة النظام</button>
        <button class="auth-tab" id="tab-jury">عضو لجنة التحكيم</button>
      </div>
      <div class="auth-error" id="auth-error">البريد الإلكتروني أو كلمة المرور غير صحيحة</div>
      <div class="form-group"><label class="form-label">البريد الإلكتروني</label><input class="form-input" type="email" id="login-email" placeholder="أدخل بريدك الإلكتروني"></div>
      <div class="form-group"><label class="form-label">كلمة المرور</label><input class="form-input" type="password" id="login-pass" placeholder="••••••••"></div>
      <button class="btn btn-primary" id="btn-login" style="width:100%;justify-content:center;padding:14px;">دخول إلى البوابة ←</button>
      <p style="text-align:center;font-size:12px;color:var(--text-dim);margin-top:14px;opacity:.6;">تجريبي: admin@majaaz.iq / Admin@12345</p>
    </div>
  </div>
</div>

<!-- ADMIN -->
<div id="view-admin" class="view">
  <div class="dashboard">
    <div class="sidebar">
      <div class="sidebar-logo">
        <div style="display:flex;align-items:center;gap:12px;">
          <div class="logo-mark" style="width:40px;height:40px;font-size:18px;">م</div>
          <div><div style="font-family:'Amiri',serif;font-size:15px;font-weight:700;">مجاز</div><div style="font-family:'IBM Plex Mono',monospace;font-size:9px;color:var(--cyan);letter-spacing:.1em;">لوحة الإدارة</div></div>
        </div>
      </div>
      <button class="nav-item active" data-admin-tab="overview">📊 نظرة عامة</button>
      <button class="nav-item" data-admin-tab="projects">🏛 المشاريع</button>
      <button class="nav-item" data-admin-tab="jury">👥 أعضاء اللجنة</button>
      <button class="nav-item" data-admin-tab="evaluations">📋 التقييمات</button>
      <div class="sidebar-footer">
        <div class="user-chip"><div class="user-avatar">A</div><div><div class="user-name">المدير العام</div><div class="user-role"><span class="tag tag-admin">Admin</span></div></div></div>
        <button class="btn btn-outline" id="btn-logout-admin" style="width:100%;justify-content:center;">تسجيل الخروج</button>
      </div>
    </div>
    <div class="main-content">
      <div id="admin-overview" class="dash-section active fade-in">
        <div class="page-title">📊 نظرة عامة</div><div class="page-sub">ملخص حالة المسابقة</div>
        <div class="stats-row" id="admin-stats-row"></div>
        <div class="panel"><div class="panel-title">المشاريع الأخيرة</div><div id="admin-recent-projects"></div></div>
      </div>
      <div id="admin-projects" class="dash-section">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px;">
          <div class="page-title">🏛 المشاريع</div>
          <button class="btn btn-primary" id="btn-open-add-project">+ رفع مشروع</button>
        </div>
        <div class="page-sub">صورة غلاف + حتى ١٩ صورة إضافية مع وصف لكل منها</div>
        <div class="projects-grid" id="admin-projects-grid"></div>
        <div id="admin-projects-empty" class="empty-state" style="display:none;"><span class="empty-icon">🏛</span><p>لم تُضف مشاريع بعد</p></div>
      </div>
      <div id="admin-jury" class="dash-section">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:4px;">
          <div class="page-title">👥 لجنة التحكيم</div>
          <button class="btn btn-primary" id="btn-open-add-jury">+ إضافة عضو</button>
        </div>
        <div class="page-sub">إدارة أعضاء لجنة التحكيم</div>
        <div class="panel">
          <table class="data-table">
            <thead><tr><th>الاسم</th><th>البريد الإلكتروني</th><th>التقييمات المنشورة</th><th>إجراءات</th></tr></thead>
            <tbody id="jury-table-body"></tbody>
          </table>
          <div id="jury-empty" class="empty-state" style="display:none;"><span class="empty-icon">👥</span><p>لم يُضف أعضاء بعد</p></div>
        </div>
      </div>
      <div id="admin-evaluations" class="dash-section">
        <div class="page-title">📋 التقييمات</div><div class="page-sub">تقييمات كل عضو لجنة</div>
        <div id="admin-evals-list"></div>
      </div>
    </div>
  </div>
</div>

<!-- JURY -->
<div id="view-jury" class="view">
  <div class="dashboard">
    <div class="sidebar">
      <div class="sidebar-logo">
        <div style="display:flex;align-items:center;gap:12px;">
          <div class="logo-mark" style="width:40px;height:40px;font-size:18px;">م</div>
          <div><div style="font-family:'Amiri',serif;font-size:15px;font-weight:700;">مجاز</div><div style="font-family:'IBM Plex Mono',monospace;font-size:9px;color:var(--cyan);letter-spacing:.1em;">لجنة التحكيم</div></div>
        </div>
      </div>
      <button class="nav-item active" data-jury-tab="projects">🏛 المشاريع</button>
      <button class="nav-item" data-jury-tab="my-evals">📋 تقييماتي</button>
      <div class="sidebar-footer">
        <div class="user-chip"><div class="user-avatar" id="jury-avatar">J</div><div><div class="user-name" id="jury-sidebar-name">عضو اللجنة</div><div class="user-role"><span class="tag tag-jury">Jury</span></div></div></div>
        <button class="btn btn-outline" id="btn-logout-jury" style="width:100%;justify-content:center;">تسجيل الخروج</button>
      </div>
    </div>
    <div class="main-content">
      <div id="jury-projects" class="dash-section active fade-in">
        <div class="page-title">🏛 المشاريع للتقييم</div>
        <div class="page-sub">انقر على أي مشروع لعرض صوره وأوصافها ثم تقييمه</div>
        <div class="projects-grid" id="jury-projects-grid"></div>
      </div>
      <div id="jury-my-evals" class="dash-section">
        <div class="page-title">📋 تقييماتي</div><div class="page-sub">ملخص تقييماتك</div>
        <div id="jury-evals-list"></div>
        <div id="jury-evals-empty" class="empty-state" style="display:none;"><span class="empty-icon">📋</span><p>لم تُقدّم أي تقييم بعد</p></div>
      </div>
    </div>
  </div>
</div>

<!-- MODAL: Add Project -->
<div class="modal-overlay" id="modal-add-project">
  <div class="modal">
    <button class="modal-close" data-close="modal-add-project">✕</button>
    <div class="modal-title">🏛 رفع مشروع جديد</div>
    <div class="form-group">
      <label class="form-label">اسم المشروع</label>
      <input class="form-input" id="proj-name-input" placeholder="مثال: مشروع دار السلام">
    </div>
    <div class="form-group">
      <label class="form-label">📸 صورة الغلاف <span style="color:var(--text-dim);font-weight:400;">(تظهر في قائمة المشاريع)</span></label>
      <div class="upload-zone" id="cover-zone">
        <div class="upload-zone-icon">🖼</div>
        <div class="upload-zone-text">انقر لرفع صورة الغلاف</div>
        <div class="upload-zone-sub">PNG, JPG — حتى 1 MB</div>
      </div>
      <input type="file" id="cover-input" accept="image/*" style="display:none">
      <div id="cover-preview-wrap" style="display:none;border-radius:10px;overflow:hidden;border:1px solid var(--border);margin-top:8px;">
        <img id="cover-preview" style="width:100%;max-height:150px;object-fit:cover;">
        <div style="padding:5px 10px;font-size:12px;color:var(--cyan);background:var(--dark3);" id="cover-preview-name"></div>
      </div>
    </div>
    <div class="form-group">
      <label class="form-label">🗂 الصور الإضافية <span style="color:var(--text-dim);font-weight:400;">(حتى ١٩ — مع وصف اختياري لكل صورة)</span></label>
      <div class="upload-zone" id="multi-zone">
        <div class="upload-zone-icon">📁</div>
        <div class="upload-zone-text">انقر لإضافة الصور الإضافية</div>
        <div class="upload-zone-sub">يمكن تحديد عدة صور دفعة واحدة</div>
      </div>
      <input type="file" id="multi-input" accept="image/*" multiple style="display:none">
      <div class="multi-count" id="multi-count"></div>
      <div class="img-items-list" id="img-items-list"></div>
    </div>
    <button class="btn btn-primary" id="btn-add-project" style="width:100%;justify-content:center;padding:13px;">رفع المشروع</button>
  </div>
</div>

<!-- MODAL: Add Jury -->
<div class="modal-overlay" id="modal-add-jury">
  <div class="modal">
    <button class="modal-close" data-close="modal-add-jury">✕</button>
    <div class="modal-title">👤 إضافة عضو لجنة تحكيم</div>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
      <div class="form-group"><label class="form-label">الاسم الكامل</label><input class="form-input" id="jury-name-input" placeholder="د. أحمد محمد"></div>
      <div class="form-group"><label class="form-label">البريد الإلكتروني</label><input class="form-input" type="email" id="jury-email-input" placeholder="jury@majaaz.iq"></div>
    </div>
    <div class="form-group"><label class="form-label">كلمة المرور</label><input class="form-input" type="password" id="jury-pass-input" placeholder="كلمة مرور قوية"></div>
    <button class="btn btn-primary" id="btn-add-jury" style="width:100%;justify-content:center;">إنشاء الحساب</button>
  </div>
</div>

<!-- MODAL: Evaluate -->
<div class="modal-overlay" id="modal-evaluate">
  <div class="modal" style="max-width:660px;">
    <button class="modal-close" data-close="modal-evaluate">✕</button>
    <div class="modal-title" id="eval-modal-title">تقييم المشروع</div>
    <div id="eval-modal-body"></div>
  </div>
</div>

<!-- LIGHTBOX (with description panel) -->
<div class="lightbox" id="lightbox">
  <div class="lb-topbar">
    <div class="lb-topbar-title" id="lb-proj-name"></div>
    <div class="lb-counter-top" id="lb-counter"></div>
    <button class="lb-close" id="lb-close">✕</button>
  </div>
  <div class="lb-main">
    <!-- description panel (RTL: left side = start visually) -->
    <div class="lb-desc-panel" id="lb-desc-panel">
      <div class="lb-desc-inner">
        <div class="lb-desc-label">وصف الصورة</div>
        <div id="lb-desc-text" class="lb-desc-text"></div>
      </div>
    </div>
    <div class="lb-img-area">
      <button class="lb-nav-btn lb-prev" id="lb-prev">&#8594;</button>
      <img class="lb-img" id="lb-img" src="" alt="">
      <button class="lb-nav-btn lb-next" id="lb-next">&#8592;</button>
    </div>
  </div>
  <div class="lb-thumb-strip" id="lb-thumb-strip"></div>
</div>

<div class="toast-container" id="toast-container"></div>

<script>
(function(){
const API = {
  async get(path){
    const r = await fetch(path, {credentials:'same-origin'});
    if(!r.ok) throw new Error(await r.text());
    return r.json();
  },
  async post(path, data, isForm=false){
    const opt = {method:'POST', credentials:'same-origin'};
    if(isForm){
      opt.body = data;
    }else{
      opt.headers = {'Content-Type':'application/json'};
      opt.body = JSON.stringify(data||{});
    }
    const r = await fetch(path, opt);
    if(!r.ok) throw new Error(await r.text());
    return r.json();
  }
};

async function bootstrap(){
  try{
    const res = await API.get('api/bootstrap.php');
    // res: {ok, me, users, projects, evaluations}
    window.__ME__ = res.me || null;
    DB.users = res.users || [];
    DB.projects = res.projects || [];
    DB.evaluations = res.evaluations || [];
  }catch(e){
    console.error(e);
    toast('تعذر تحميل البيانات من السيرفر. تأكد من استيراد قاعدة البيانات.', 'error');
  }
}

// ══════════ DATA ══════════
var DB = {
  users:[],           // loaded from server (admin sees jury list)
  projects:[],        // loaded from server
  evaluations:[]      // loaded from server
};

var CRITERIA=[
  'يهدف المشروع إلى حل مشكلة محددة وواقعية (اجتماعية، جغرافية، ثقافية، وظيفية)',
  'يقترح المشروع خطة حل واضحة وناجحة للمشكلة المطروحة',
  'يُظهر الطالب منطقاً تصميمياً قوياً في قراراته (الكتلة، التوزيع، الفتحات، الحركة)',
  'لا يعاني المشروع من إشكاليات وظيفية جوهرية',
  'يبدو المشروع متناغماً مع موقعه ومتكيفاً مع بيئته المحلية والجغرافية',
  'يستجيب المشروع للمناخ والمواد المحلية وتقاليد البناء في المنطقة',
  'الرسومات المقدمة (ثنائية وثلاثية الأبعاد) مفصّلة وواضحة وتشرح المشروع بشكل جيد',
  'يعكس المشروع جدية الطالب واجتهاده الواضح'
];
var LIKERT=[{label:'غير موافق بشدة',val:2},{label:'غير موافق',val:4},{label:'محايد',val:6},{label:'موافق',val:8},{label:'موافق بشدة',val:10}];
var MAX_SCORE=80;

var evalScores=[], evalProjectId=null, currentAdminTab='overview';
var stageCover=null, stageImages=[]; // stageImages: [{dataUrl, name, desc}]

// lightbox state
var lbItems=[]; // [{dataUrl, desc}]
var lbIndex=0;
var lbProjName='';

// ══════════ UTILS ══════════
function genId(){ return 'id_'+Math.random().toString(36).substr(2,9); }
function norm(r){ return Math.round((r/MAX_SCORE)*100); }
function showView(v){
  document.querySelectorAll('.view').forEach(function(el){ el.classList.remove('active'); });
  document.getElementById('view-'+v).classList.add('active');
  window.scrollTo(0,0);
  if(v==='public') renderPublic();
}
function showToast(msg,type){
  type=type||'success';
  var c=document.getElementById('toast-container');
  var t=document.createElement('div');
  t.className='toast '+type;
  t.textContent=(type==='success'?'✓ ':'✕ ')+msg;
  c.appendChild(t);
  setTimeout(function(){ t.remove(); },3500);
}
function openModal(id){ document.getElementById(id).classList.add('open'); }
function closeModal(id){ document.getElementById(id).classList.remove('open'); }
function readFile(file,cb){ var r=new FileReader(); r.onload=function(e){ cb(e.target.result); }; r.readAsDataURL(file); }

// ══════════ LIGHTBOX ══════════
function openLightbox(items, idx, projName){
  lbItems=items; lbIndex=idx||0; lbProjName=projName||'';
  document.getElementById('lb-proj-name').textContent=lbProjName;
  buildThumbStrip();
  updateLightbox();
  document.getElementById('lightbox').classList.add('open');
}
function buildThumbStrip(){
  var strip=document.getElementById('lb-thumb-strip');
  strip.innerHTML='';
  lbItems.forEach(function(item,i){
    var img=document.createElement('img');
    img.className='lb-thumb'+(i===lbIndex?' active':'');
    img.src=item.dataUrl;
    img.addEventListener('click',function(){ lbIndex=i; updateLightbox(); });
    strip.appendChild(img);
  });
}
function updateLightbox(){
  var item=lbItems[lbIndex];
  document.getElementById('lb-img').src=item.dataUrl;
  document.getElementById('lb-counter').textContent=(lbIndex+1)+' / '+lbItems.length;
  // description
  var descEl=document.getElementById('lb-desc-text');
  var panel=document.getElementById('lb-desc-panel');
  if(item.desc&&item.desc.trim()){
    descEl.innerHTML='<span>'+item.desc.trim()+'</span>';
    descEl.className='lb-desc-text';
    panel.style.display='flex';
  } else {
    descEl.innerHTML='<span class="lb-desc-empty">لا يوجد وصف لهذه الصورة</span>';
    panel.style.display='flex';
  }
  // thumb strip active
  document.querySelectorAll('.lb-thumb').forEach(function(t,i){ t.classList.toggle('active',i===lbIndex); });
  // scroll active thumb into view
  var activeThumb=document.querySelectorAll('.lb-thumb')[lbIndex];
  if(activeThumb) activeThumb.scrollIntoView({behavior:'smooth',block:'nearest',inline:'center'});
}
document.getElementById('lb-close').addEventListener('click',function(){ document.getElementById('lightbox').classList.remove('open'); });
document.getElementById('lb-prev').addEventListener('click',function(){ lbIndex=(lbIndex-1+lbItems.length)%lbItems.length; updateLightbox(); });
document.getElementById('lb-next').addEventListener('click',function(){ lbIndex=(lbIndex+1)%lbItems.length; updateLightbox(); });
document.getElementById('lightbox').addEventListener('click',function(e){ if(e.target===this) this.classList.remove('open'); });
document.addEventListener('keydown',function(e){
  if(!document.getElementById('lightbox').classList.contains('open')) return;
  if(e.key==='ArrowLeft') document.getElementById('lb-next').click();
  if(e.key==='ArrowRight') document.getElementById('lb-prev').click();
  if(e.key==='Escape') document.getElementById('lightbox').classList.remove('open');
});

// ══════════ PUBLIC LIST ══════════
function renderPublic(){
  var grid=document.getElementById('pub-grid');
  var empty=document.getElementById('pub-empty');
  var pubEvals=DB.evaluations.filter(function(e){ return e.published; });
  var evMap={};
  pubEvals.forEach(function(e){ evMap[e.projectId]=(evMap[e.projectId]||0)+1; });
  document.getElementById('pub-total').textContent=DB.projects.length;
  document.getElementById('pub-evaluated').textContent=Object.keys(evMap).length;
  document.getElementById('pub-evals-count').textContent=pubEvals.length;
  grid.innerHTML='';
  if(!DB.projects.length){ empty.style.display='block'; grid.style.display='none'; return; }
  empty.style.display='none'; grid.style.display='grid';
  DB.projects.forEach(function(p){
    var evCount=evMap[p.id]||0;
    var totalImgs=(p.cover?1:0)+p.images.length;
    var card=document.createElement('div');
    card.className='pub-card fade-in';
    card.innerHTML='<div class="pub-card-img-wrap">'
      +(p.cover?'<img class="pub-card-cover" src="'+p.cover+'">'
        :'<div class="pub-card-cover-ph">🏛</div>')
      +'<div class="pub-card-arrow">👁</div>'
      +(totalImgs>1?'<div class="img-count-badge">📷 '+totalImgs+' صور</div>':'')
      +'</div>'
      +'<div class="pub-card-body">'
      +'<div class="pub-card-name">'+p.name+'</div>'
      +'<div class="pub-card-meta">'
      +(evCount?'<span style="color:#00e564;">'+evCount+' تقييم منشور</span><span class="badge badge-success">مُقيَّم</span>'
        :'<span style="color:var(--text-dim);">بانتظار التقييم</span><span class="badge badge-pending">قريباً</span>')
      +'</div></div>';
    card.addEventListener('click',function(){ showProjectDetail(p.id); });
    grid.appendChild(card);
  });
}

// ══════════ PROJECT DETAIL ══════════
function showProjectDetail(pid){
  var p=DB.projects.filter(function(x){ return x.id===pid; })[0];
  if(!p) return;
  var pubEvals=DB.evaluations.filter(function(e){ return e.projectId===pid&&e.published; });

  // build lightbox items: cover first (no desc), then additional images with desc
  var lbItemsList=[];
  if(p.cover) lbItemsList.push({dataUrl:p.cover, desc:''});
  p.images.forEach(function(img){ lbItemsList.push({dataUrl:img.dataUrl, desc:img.desc||''}); });

  // hero
  var heroHtml='<div class="detail-hero" id="detail-hero-click">'
    +(p.cover?'<img class="detail-hero-img" src="'+p.cover+'">'
      :'<div class="detail-hero-ph">🏛</div>')
    +'<div class="detail-hero-overlay"></div>'
    +'<div class="detail-hero-title"><h1>'+p.name+'</h1>'
    +(pubEvals.length?'<span class="badge badge-success">'+pubEvals.length+' تقييم منشور</span>':'<span class="badge badge-pending">بانتظار التقييم</span>')
    +'</div></div>';

  // gallery with descriptions
  var galleryHtml='<div style="margin-bottom:48px;"><div class="gallery-label">🗂 معرض الصور</div>';
  if(p.images.length){
    galleryHtml+='<div class="gallery-grid">'
      +p.images.map(function(img,i){
        var lbIdx=p.cover?i+1:i;
        return '<div class="gallery-item" data-lb-idx="'+lbIdx+'" style="position:relative;">'
          +'<span class="gallery-item-num">'+(i+1)+'</span>'
          +'<img class="gallery-item-img" src="'+img.dataUrl+'">'
          +'<div class="gallery-item-desc'+(img.desc?'':' empty')+'">'
          +(img.desc?'<span class="gallery-item-desc-icon">📝</span><span>'+img.desc+'</span>':'')
          +'</div></div>';
      }).join('')
      +'</div>';
  } else {
    galleryHtml+='<div style="padding:30px;text-align:center;color:var(--text-dim);font-size:13px;background:var(--dark2);border-radius:12px;border:1px dashed var(--border-subtle);">لم تُرفع صور إضافية</div>';
  }
  galleryHtml+='</div>';

  // evaluations
  var evalsHtml='<div class="evals-section"><div class="gallery-label">📋 تقييمات لجنة التحكيم</div>';
  if(!pubEvals.length){
    evalsHtml+='<div class="no-evals">⏳ لم تُنشر أي تقييمات لهذا المشروع بعد</div>';
  } else {
    evalsHtml+=pubEvals.map(function(ev){
      var juror=DB.users.filter(function(u){ return u.id===ev.juryId; })[0];
      var pct=(ev.rawScore/MAX_SCORE)*100;
      return '<div class="eval-card">'
        +'<div class="eval-card-header">'
        +'<div class="eval-juror">👤 '+(juror?juror.name:'محكّم')+'</div>'
        +'<div style="text-align:left;">'
        +'<div class="eval-total">'+ev.rawScore+' / '+MAX_SCORE+'</div>'
        +'<div class="eval-norm">'+norm(ev.rawScore)+' / 100</div>'
        +'</div></div>'
        +'<div style="height:5px;background:var(--dark4);border-radius:3px;overflow:hidden;margin-bottom:16px;">'
        +'<div style="height:100%;width:'+pct+'%;background:linear-gradient(90deg,var(--cyan-dim),var(--cyan));border-radius:3px;"></div></div>'
        +'<div class="eval-scores-wrap">'
        +CRITERIA.map(function(q,i){
          var s=ev.scores[i]; var sp=(s/10)*100;
          return '<div class="eval-crit-row">'
            +'<div class="eval-crit-text">'+(i+1)+'. '+q+'</div>'
            +'<div style="text-align:left;min-width:36px;">'
            +'<div class="eval-crit-score">'+s+'</div>'
            +'<div class="eval-score-bar"><div class="eval-score-fill" style="width:'+sp+'%"></div></div>'
            +'</div></div>';
        }).join('')
        +'</div>'
        +(ev.comment?'<div class="eval-comment-block">"'+ev.comment+'"</div>':'')
        +'</div>';
    }).join('');
  }
  evalsHtml+='</div>';

  document.getElementById('detail-content').innerHTML=heroHtml+'<div class="detail-body">'+galleryHtml+evalsHtml+'</div>';

  // bind hero click → lightbox at index 0
  var heroEl=document.getElementById('detail-hero-click');
  if(lbItemsList.length) heroEl.addEventListener('click',function(){ openLightbox(lbItemsList,0,p.name); });

  // bind gallery items → lightbox
  document.querySelectorAll('.gallery-item[data-lb-idx]').forEach(function(el){
    el.addEventListener('click',function(){ openLightbox(lbItemsList,parseInt(this.dataset.lbIdx),p.name); });
  });

  showView('project-detail');
}

// ══════════ ADMIN ══════════
function adminTab(tab){
  currentAdminTab=tab;
  document.querySelectorAll('[data-admin-tab]').forEach(function(b){ b.classList.toggle('active',b.dataset.adminTab===tab); });
  document.querySelectorAll('#view-admin .dash-section').forEach(function(s){ s.classList.remove('active'); });
  document.getElementById('admin-'+tab).classList.add('active');
  renderAdminSection(tab);
}
function renderAdminSection(tab){
  if(tab==='overview') renderAdminOverview();
  else if(tab==='projects') renderAdminProjects();
  else if(tab==='jury') renderAdminJury();
  else if(tab==='evaluations') renderAdminEvals();
}
function renderAdminOverview(){
  var juryCount=DB.users.filter(function(u){ return u.role==='jury'; }).length;
  var pubEvals=DB.evaluations.filter(function(e){ return e.published; }).length;
  document.getElementById('admin-stats-row').innerHTML=
    '<div class="stat-card"><div class="stat-card-num">'+DB.projects.length+'</div><div class="stat-card-label">مشروع</div></div>'
    +'<div class="stat-card"><div class="stat-card-num">'+juryCount+'</div><div class="stat-card-label">عضو تحكيم</div></div>'
    +'<div class="stat-card"><div class="stat-card-num">'+pubEvals+'</div><div class="stat-card-label">تقييم منشور</div></div>'
    +'<div class="stat-card"><div class="stat-card-num">'+(DB.evaluations.length-pubEvals)+'</div><div class="stat-card-label">تقييم محفوظ</div></div>';
  var el=document.getElementById('admin-recent-projects');
  if(!DB.projects.length){ el.innerHTML='<div class="empty-state"><span class="empty-icon">🏛</span><p>لا توجد مشاريع</p></div>'; return; }
  el.innerHTML='<table class="data-table"><thead><tr><th>المشروع</th><th>الصور</th><th>بأوصاف</th><th>تقييمات</th></tr></thead><tbody>'
    +DB.projects.slice().reverse().slice(0,6).map(function(p){
      var pub=DB.evaluations.filter(function(e){ return e.projectId===p.id&&e.published; }).length;
      var imgs=(p.cover?1:0)+p.images.length;
      var described=p.images.filter(function(i){ return i.desc&&i.desc.trim(); }).length;
      return '<tr><td><strong>'+p.name+'</strong></td>'
        +'<td><span class="badge badge-saved">'+imgs+' / 20</span></td>'
        +'<td><span style="color:var(--gold);font-family:\'IBM Plex Mono\',monospace;font-size:12px;">'+described+' صورة</span></td>'
        +'<td><span class="badge badge-success">'+pub+'</span></td></tr>';
    }).join('')+'</tbody></table>';
}
function renderAdminProjects(){
  var grid=document.getElementById('admin-projects-grid');
  var empty=document.getElementById('admin-projects-empty');
  grid.innerHTML='';
  if(!DB.projects.length){ empty.style.display='block'; grid.style.display='none'; return; }
  empty.style.display='none'; grid.style.display='grid';
  DB.projects.forEach(function(p){
    var pub=DB.evaluations.filter(function(e){ return e.projectId===p.id&&e.published; }).length;
    var imgCount=(p.cover?1:0)+p.images.length;
    var described=p.images.filter(function(i){ return i.desc&&i.desc.trim(); }).length;
    var card=document.createElement('div');
    card.className='proj-card';
    card.innerHTML=(p.cover?'<img class="proj-card-cover" src="'+p.cover+'">'
      :'<div class="proj-card-cover-ph">🏛</div>')
      +'<div class="proj-card-body">'
      +'<div class="proj-card-name">'+p.name+'</div>'
      +'<div class="proj-card-meta"><span>📷 '+imgCount+' صورة | 📝 '+described+' وصف</span></div>'
      +'<div class="proj-card-meta" style="margin-top:4px;">'
      +(pub?'<span class="badge badge-success">'+pub+' تقييم</span>':'<span class="badge badge-pending">بانتظار</span>')
      +'</div>'
      +'<div class="proj-card-actions">'
      +'<button class="btn btn-danger" style="padding:6px 10px;font-size:12px;" data-del-proj="'+p.id+'">🗑 حذف</button>'
      +'</div></div>';
    grid.appendChild(card);
  });
  document.querySelectorAll('[data-del-proj]').forEach(function(btn){
    btn.addEventListener('click',function(){
      var id=this.dataset.delProj;
      if(!confirm('هل تريد حذف هذا المشروع؟')) return;
      (async()=>{ try{ await API.post('api/admin_delete_project.php', {projectId: pid}); const res = await API.get('api/bootstrap.php'); DB.projects=res.projects||[]; DB.evaluations=res.evaluations||[]; toast('تم حذف المشروع','success'); }catch(e){ toast('تعذر حذف المشروع','error'); } })();
showToast('تم حذف المشروع'); renderAdminProjects();
    });
  });
}
function renderAdminJury(){
  var tbody=document.getElementById('jury-table-body');
  var empty=document.getElementById('jury-empty');
  var members=DB.users.filter(function(u){ return u.role==='jury'; });
  tbody.innerHTML='';
  empty.style.display=members.length?'none':'block';
  members.forEach(function(m){
    var pub=DB.evaluations.filter(function(e){ return e.juryId===m.id&&e.published; }).length;
    var tr=document.createElement('tr');
    tr.innerHTML='<td><strong>'+m.name+'</strong></td>'
      +'<td style="font-family:\'IBM Plex Mono\',monospace;font-size:12px;direction:ltr;">'+m.email+'</td>'
      +'<td><span class="badge badge-success">'+pub+' / '+DB.projects.length+'</span></td>'
      +'<td><button class="btn btn-danger" style="padding:6px 12px;font-size:12px;" data-remove-jury="'+m.id+'">حذف</button></td>';
    tbody.appendChild(tr);
  });
  document.querySelectorAll('[data-remove-jury]').forEach(function(btn){
    btn.addEventListener('click',function(){
      var id=this.dataset.removeJury;
      if(!confirm('هل تريد حذف هذا العضو؟')) return;
      DB.users=DB.users.filter(function(u){ return u.id!==id; });
      showToast('تم حذف العضو'); renderAdminJury();
    });
  });
}
function renderAdminEvals(){
  var container=document.getElementById('admin-evals-list');
  container.innerHTML='';
  var members=DB.users.filter(function(u){ return u.role==='jury'; });
  if(!members.length){ container.innerHTML='<div class="empty-state"><span class="empty-icon">👥</span><p>لم يُضف أعضاء لجنة بعد</p></div>'; return; }
  members.forEach(function(m){
    var myEvals=DB.evaluations.filter(function(e){ return e.juryId===m.id; });
    var block=document.createElement('div');
    block.className='panel';
    block.innerHTML='<div class="panel-title">👤 '+m.name
      +'<span style="margin-right:auto;font-size:12px;color:var(--text-dim);">'+myEvals.filter(function(e){ return e.published; }).length+' منشور / '+DB.projects.length+' مشروع</span></div>'
      +(!myEvals.length?'<div style="color:var(--text-dim);font-size:13px;padding:10px 0;">لم يُقيِّم أي مشروع بعد</div>'
        :'<table class="data-table"><thead><tr><th>المشروع</th><th>الدرجة</th><th>من 100</th><th>الحالة</th></tr></thead><tbody>'
        +myEvals.map(function(ev){
          var p=DB.projects.filter(function(x){ return x.id===ev.projectId; })[0];
          return '<tr><td>'+(p?p.name:'مشروع')+'</td>'
            +'<td style="font-family:\'IBM Plex Mono\',monospace;color:var(--cyan);">'+ev.rawScore+' / '+MAX_SCORE+'</td>'
            +'<td style="font-family:\'IBM Plex Mono\',monospace;color:var(--gold);">'+norm(ev.rawScore)+'</td>'
            +'<td>'+(ev.published?'<span class="badge badge-success">منشور</span>':'<span class="badge badge-saved">محفوظ</span>')+'</td></tr>';
        }).join('')+'</tbody></table>');
    container.appendChild(block);
  });
}

// ══════════ PROJECT UPLOAD ══════════
function resetProjectModal(){
  document.getElementById('proj-name-input').value='';
  stageCover=null; stageImages=[];
  document.getElementById('cover-preview-wrap').style.display='none';
  document.getElementById('cover-preview').src='';
  document.getElementById('cover-preview-name').textContent='';
  document.getElementById('cover-input').value='';
  document.getElementById('multi-input').value='';
  document.getElementById('img-items-list').innerHTML='';
  document.getElementById('multi-count').textContent='';
}
function renderImgItems(){
  var list=document.getElementById('img-items-list');
  list.innerHTML='';
  stageImages.forEach(function(img,i){
    var div=document.createElement('div');
    div.className='img-item';
    div.innerHTML='<img class="img-item-thumb" src="'+img.dataUrl+'">'
      +'<div class="img-item-body">'
      +'<div class="img-item-name">📷 '+img.name+'</div>'
      +'<textarea class="img-item-desc-input" rows="2" placeholder="وصف اختياري لهذه الصورة..." data-idx="'+i+'">'+img.desc+'</textarea>'
      +'</div>'
      +'<button class="img-item-remove" data-rem="'+i+'">✕</button>';
    list.appendChild(div);
  });
  // bind desc inputs live
  list.querySelectorAll('.img-item-desc-input').forEach(function(ta){
    ta.addEventListener('input',function(){ stageImages[parseInt(this.dataset.idx)].desc=this.value; });
  });
  // bind remove buttons
  list.querySelectorAll('[data-rem]').forEach(function(btn){
    btn.addEventListener('click',function(){
      stageImages.splice(parseInt(this.dataset.rem),1);
      renderImgItems();
      document.getElementById('multi-count').textContent=stageImages.length+' / 19 صورة'+(stageImages.length===19?' (الحد الأقصى)':'');
    });
  });
  document.getElementById('multi-count').textContent=stageImages.length?stageImages.length+' / 19 صورة'+(stageImages.length===19?' (الحد الأقصى)':''):'';
}

document.getElementById('cover-zone').addEventListener('click',function(){ document.getElementById('cover-input').click(); });
document.getElementById('cover-input').addEventListener('change',function(){
  if(!this.files||!this.files[0]) return;
  var file=this.files[0];
  if(file.size>1048576){ showToast('صورة الغلاف أكبر من 1 MB','error'); return; }
  readFile(file,function(url){
    stageCover={dataUrl:url,name:file.name};
    document.getElementById('cover-preview').src=url;
    document.getElementById('cover-preview-name').textContent='✓ '+file.name;
    document.getElementById('cover-preview-wrap').style.display='block';
  });
});
document.getElementById('multi-zone').addEventListener('click',function(){ document.getElementById('multi-input').click(); });
document.getElementById('multi-input').addEventListener('change',function(){
  if(!this.files) return;
  var files=Array.from(this.files);
  var remaining=19-stageImages.length;
  if(!remaining){ showToast('وصلت للحد الأقصى 19 صورة','error'); return; }
  var oversized=files.filter(function(f){ return f.size>1048576; });
  if(oversized.length) showToast(oversized.length+' صورة تتجاوز 1 MB — تم تجاهلها','error');
  var toAdd=files.filter(function(f){ return f.size<=1048576; }).slice(0,remaining);
  var done=0;
  toAdd.forEach(function(file){
    readFile(file,function(url){
      stageImages.push({dataUrl:url,name:file.name,desc:''});
      done++;
      if(done===toAdd.length) renderImgItems();
    });
  });
  this.value='';
});
document.getElementById('btn-add-project').addEventListener('click',function(){
  var name=document.getElementById('proj-name-input').value.trim();
  if(!name){ showToast('يرجى إدخال اسم المشروع','error'); return; }
  // collect descriptions from inputs
  document.querySelectorAll('.img-item-desc-input').forEach(function(ta){ stageImages[parseInt(ta.dataset.idx)].desc=ta.value; });
  (async()=>{ try{ const res = await API.post('api/admin_create_project.php', {
    id:genId(),
    name:name,
    cover:stageCover?stageCover.dataUrl:null,
    images:stageImages.map(function(i){ return {dataUrl:i.dataUrl, desc:i.desc||''}; }),
    createdAt:Date.now()
  }); DB.projects = res.projects || DB.projects;
    renderAdminProjects();
    renderAdminSection(currentAdminTab);
    toast('تم إضافة المشروع', 'success'); }catch(e){ toast('تعذر إضافة المشروع', 'error'); } })();
  closeModal('modal-add-project');
  showToast('تم رفع المشروع — '+((stageCover?1:0)+stageImages.length)+' صورة');
  renderAdminSection(currentAdminTab);
  renderPublic();
});

// ══════════ ADD JURY ══════════
document.getElementById('btn-add-jury').addEventListener('click',function(){
  var name=document.getElementById('jury-name-input').value.trim();
  var email=document.getElementById('jury-email-input').value.trim();
  var pass=document.getElementById('jury-pass-input').value;
  if(!name||!email||!pass){ showToast('يرجى تعبئة جميع الحقول','error'); return; }
  if(DB.users.some(function(u){ return u.email===email; })){ showToast('البريد مسجّل مسبقاً','error'); return; }
  (async()=>{ try{ const res = await API.post('api/admin_create_jury.php', {id:genId(),email:email,password:pass,role:'jury',name:name}); DB.users = res.users || DB.users;
    renderAdminJury();
    toast('تم إنشاء حساب المحكم', 'success'); }catch(e){ toast('تعذر إنشاء الحساب', 'error'); } })();
  closeModal('modal-add-jury');
  showToast('تم إنشاء حساب عضو اللجنة');
  renderAdminSection('jury');
});

// ══════════ AUTH ══════════
async function doLogin(){
  var email=document.getElementById('login-email').value.trim();
  var pass=document.getElementById('login-pass').value;

  try{
    var res = await API.post('api/login.php', {email: email, password: pass});
    if(!res || !res.ok || !res.user) throw new Error('bad');

    DB.currentUser = res.user; // {id,name,email,role}
    document.getElementById('auth-error').classList.remove('show');

    if(DB.currentUser.role==='admin'){ showView('admin'); renderAdminSection('overview'); }
    else { showView('jury'); juryTab('projects'); renderJuryProjects(); }
  }catch(e){
    document.getElementById('auth-error').classList.add('show');
  }
}
async function doLogout(){
  try{ await API.post('api/logout.php', {}); }catch(e){}
  DB.currentUser=null;
  document.getElementById('login-email').value='';
  document.getElementById('login-pass').value='';
  showView('public');
}
function getMyEval(pid){ for(var i=0;i<DB.evaluations.length;i++){ if(DB.evaluations[i].projectId===pid&&DB.evaluations[i].juryId===DB.currentUser.id) return DB.evaluations[i]; } return null; }
function renderJuryProjects(){
  var grid=document.getElementById('jury-projects-grid');
  grid.innerHTML='';
  if(!DB.projects.length){ grid.innerHTML='<div class="empty-state"><span class="empty-icon">🏛</span><p>لا توجد مشاريع بعد</p></div>'; return; }
  DB.projects.forEach(function(p){
    var ev=getMyEval(p.id);
    var card=document.createElement('div');
    card.className='jury-proj-card';
    var statusBadge=ev&&ev.published?'<span class="badge badge-success" style="position:absolute;bottom:8px;left:8px;">✓ منشور</span>'
      :ev?'<span class="badge badge-saved" style="position:absolute;bottom:8px;left:8px;">💾 محفوظ</span>':'';
    card.innerHTML='<div style="position:relative;">'
      +(p.cover?'<img style="width:100%;height:150px;object-fit:cover;" src="'+p.cover+'">'
        :'<div style="width:100%;height:150px;background:linear-gradient(135deg,var(--dark3),var(--dark4));display:flex;align-items:center;justify-content:center;font-size:36px;">🏛</div>')
      +statusBadge+'</div>'
      +'<div style="padding:14px;">'
      +'<div style="font-family:\'Amiri\',serif;font-size:15px;font-weight:700;margin-bottom:6px;">'+p.name+'</div>'
      +'<div style="font-size:12px;color:var(--text-dim);display:flex;justify-content:space-between;margin-bottom:10px;">'
      +'<span>📷 '+((p.cover?1:0)+p.images.length)+' صورة</span>'
      +(ev?'<span style="font-family:\'IBM Plex Mono\',monospace;color:var(--cyan);">'+ev.rawScore+'/'+MAX_SCORE+'</span>':'')
      +'</div>'
      +'<div style="display:flex;gap:8px;">'
      +'<button class="btn btn-outline" style="flex:1;padding:8px;font-size:12px;" data-view-proj="'+p.id+'">👁 عرض الصور</button>'
      +'<button class="btn btn-primary" style="flex:1;padding:8px;font-size:12px;" data-eval-proj="'+p.id+'">'
      +(ev&&ev.published?'✓ مُقيَّم':ev?'✏️ تعديل':'📋 تقييم')+'</button>'
      +'</div></div>';
    grid.appendChild(card);
  });
  document.querySelectorAll('[data-view-proj]').forEach(function(btn){
    btn.addEventListener('click',function(e){ e.stopPropagation(); showProjectDetail(this.dataset.viewProj); });
  });
  document.querySelectorAll('[data-eval-proj]').forEach(function(btn){
    btn.addEventListener('click',function(e){ e.stopPropagation(); openEvalModal(this.dataset.evalProj); });
  });
}
function renderJuryMyEvals(){
  var container=document.getElementById('jury-evals-list');
  var empty=document.getElementById('jury-evals-empty');
  var myEvals=DB.evaluations.filter(function(e){ return e.juryId===DB.currentUser.id; });
  container.innerHTML='';
  empty.style.display=myEvals.length?'none':'block';
  myEvals.forEach(function(ev){
    var p=DB.projects.filter(function(x){ return x.id===ev.projectId; })[0];
    var pct=(ev.rawScore/MAX_SCORE)*100;
    var div=document.createElement('div');
    div.className='panel';
    div.innerHTML='<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:12px;">'
      +'<div style="font-family:\'Amiri\',serif;font-size:18px;font-weight:700;">'+(p?p.name:'مشروع')+'</div>'
      +'<div style="text-align:left;">'
      +'<div style="font-family:\'IBM Plex Mono\',monospace;font-size:22px;color:var(--cyan);font-weight:700;">'+ev.rawScore+'/'+MAX_SCORE+'</div>'
      +'<div style="font-family:\'IBM Plex Mono\',monospace;font-size:12px;color:var(--gold);">'+norm(ev.rawScore)+' / 100</div>'
      +'</div></div>'
      +'<div style="height:5px;background:var(--dark4);border-radius:3px;overflow:hidden;margin-bottom:12px;">'
      +'<div style="height:100%;width:'+pct+'%;background:linear-gradient(90deg,var(--cyan-dim),var(--cyan));border-radius:3px;"></div></div>'
      +(ev.published?'<span class="badge badge-success">✓ منشور للعموم</span>':'<span class="badge badge-saved">💾 محفوظ — غير منشور</span>');
    container.appendChild(div);
  });
}

// ══════════ EVAL MODAL ══════════
function openEvalModal(pid){
  evalProjectId=pid;
  var p=DB.projects.filter(function(x){ return x.id===pid; })[0];
  var existing=getMyEval(pid);
  document.getElementById('eval-modal-title').textContent='📋 تقييم: '+p.name;
  evalScores=existing?existing.scores.slice():CRITERIA.map(function(){ return 0; });
  var body=document.getElementById('eval-modal-body');
  if(existing&&existing.published){
    body.innerHTML='<div style="background:rgba(0,229,100,0.06);border:1px solid rgba(0,229,100,0.2);border-radius:10px;padding:14px;text-align:center;margin-bottom:16px;color:#00e564;font-weight:700;">✓ تم النشر — لا يمكن التعديل</div>'
      +'<div class="score-display">'+existing.rawScore+' / '+MAX_SCORE+'<span class="norm">'+norm(existing.rawScore)+' / 100</span><small>الدرجة الإجمالية</small></div>'
      +CRITERIA.map(function(q,i){
        return '<div style="display:flex;justify-content:space-between;padding:9px 0;border-bottom:1px solid var(--border-subtle);font-size:13px;">'
          +'<span style="color:var(--text-dim);flex:1;">'+(i+1)+'. '+q+'</span>'
          +'<span style="font-family:\'IBM Plex Mono\',monospace;color:var(--cyan);font-weight:700;margin-right:10px;">'+existing.scores[i]+'</span></div>';
      }).join('')
      +(existing.comment?'<div class="eval-comment-block" style="margin-top:14px;">"'+existing.comment+'"</div>':'');
    openModal('modal-evaluate'); return;
  }
  var answered=evalScores.filter(function(s){ return s>0; }).length;
  var raw=evalScores.reduce(function(a,b){ return a+b; },0);
  body.innerHTML=(existing?'<div style="padding:10px 14px;background:rgba(100,150,255,0.08);border:1px solid rgba(100,150,255,0.25);border-radius:8px;font-size:13px;color:#6496ff;margin-bottom:14px;">💾 يوجد تقييم محفوظ — يمكنك تعديله أو نشره</div>':'')
    +'<div class="eval-progress"><div class="eval-progress-bar"><div class="eval-progress-fill" id="prog-fill" style="width:'+(answered/CRITERIA.length*100)+'%"></div></div><div class="eval-progress-text" id="prog-text">'+answered+' / '+CRITERIA.length+'</div></div>'
    +'<div class="score-display" id="live-score">'+raw+' / '+MAX_SCORE+'<span class="norm">'+norm(raw)+' / 100</span><small>الدرجة الإجمالية</small></div>'
    +CRITERIA.map(function(q,i){
      return '<div class="likert-group"><div class="likert-q"><span>'+(i+1)+'.</span> '+q+'</div>'
        +'<div class="likert-scale">'+LIKERT.map(function(lk){
          return '<button class="likert-btn'+(evalScores[i]===lk.val?' selected':'')+'" data-q="'+i+'" data-v="'+lk.val+'">'
            +'<span class="lk-val">'+lk.val+'</span>'+lk.label+'</button>';
        }).join('')+'</div></div>';
    }).join('')
    +'<div style="height:1px;background:var(--border-subtle);margin:20px 0;"></div>'
    +'<div class="form-group"><label class="form-label">تعليق عام (اختياري)</label>'
    +'<textarea class="form-input" id="eval-comment" rows="3" placeholder="أضف ملاحظاتك...">'+(existing?existing.comment:'')+'</textarea></div>'
    +'<div class="modal-actions"><button class="btn btn-save" id="btn-save-only">💾 حفظ فقط</button><button class="btn btn-primary" id="btn-save-publish">✓ حفظ ونشر</button></div>'
    +'<p style="font-size:11px;color:var(--text-dim);text-align:center;margin-top:10px;opacity:.7;">⚠️ بعد النشر لا يمكن التعديل</p>';
  body.querySelectorAll('.likert-btn').forEach(function(btn){
    btn.addEventListener('click',function(){ setScore(parseInt(this.dataset.q),parseInt(this.dataset.v)); });
  });
  document.getElementById('btn-save-only').addEventListener('click',function(){ saveEval(false); });
  document.getElementById('btn-save-publish').addEventListener('click',function(){ saveEval(true); });
  openModal('modal-evaluate');
}
function setScore(q,v){
  evalScores[q]=v;
  document.querySelectorAll('[data-q="'+q+'"]').forEach(function(b){ b.classList.toggle('selected',parseInt(b.dataset.v)===v); });
  var raw=evalScores.reduce(function(a,b){ return a+b; },0);
  var answered=evalScores.filter(function(s){ return s>0; }).length;
  var el=document.getElementById('live-score');
  if(el) el.innerHTML=raw+' / '+MAX_SCORE+'<span class="norm">'+norm(raw)+' / 100</span><small>الدرجة الإجمالية</small>';
  var pf=document.getElementById('prog-fill'); if(pf) pf.style.width=(answered/CRITERIA.length*100)+'%';
  var pt=document.getElementById('prog-text'); if(pt) pt.textContent=answered+' / '+CRITERIA.length;
}
function saveEval(publish){
  if(evalScores.some(function(s){ return s===0; })){ showToast('يرجى الإجابة على جميع المعايير الثمانية','error'); return; }
  var comment=document.getElementById('eval-comment').value.trim();
  var raw=evalScores.reduce(function(a,b){ return a+b; },0);
  DB.evaluations=DB.evaluations.filter(function(e){ return !(e.projectId===evalProjectId&&e.juryId===DB.currentUser.id); });
  (async()=>{ try{ await API.post('api/jury_save_evaluation.php', evalObj); const res = await API.get('api/bootstrap.php'); DB.evaluations=res.evaluations||[]; toast('تم حفظ التقييم','success'); }catch(e){ toast('تعذر حفظ التقييم','error'); } })();
  closeModal('modal-evaluate');
  showToast(publish?'تم النشر بنجاح 🎉':'تم الحفظ 💾');
  renderJuryProjects();
}

// ══════════ EVENT BINDINGS ══════════
document.getElementById('btn-go-auth').addEventListener('click',function(){ showView('auth'); });
document.getElementById('btn-back-public').addEventListener('click',function(){ showView('public'); });
document.getElementById('btn-login').addEventListener('click',doLogin);
document.getElementById('login-pass').addEventListener('keydown',function(e){ if(e.key==='Enter') doLogin(); });
document.getElementById('detail-back').addEventListener('click',function(){ showView('public'); });
document.getElementById('detail-logo-home').addEventListener('click',function(){ showView('public'); });
document.getElementById('logo-home').addEventListener('click',function(){ showView('public'); });
document.getElementById('btn-logout-admin').addEventListener('click',doLogout);
document.getElementById('btn-logout-jury').addEventListener('click',doLogout);
document.getElementById('btn-open-add-project').addEventListener('click',function(){ resetProjectModal(); openModal('modal-add-project'); });
document.getElementById('btn-open-add-jury').addEventListener('click',function(){
  document.getElementById('jury-name-input').value='';
  document.getElementById('jury-email-input').value='';
  document.getElementById('jury-pass-input').value='';
  openModal('modal-add-jury');
});
['tab-admin','tab-jury'].forEach(function(id){
  document.getElementById(id).addEventListener('click',function(){
    document.querySelectorAll('.auth-tab').forEach(function(t){ t.classList.remove('active'); });
    this.classList.add('active');
    document.getElementById('auth-error').classList.remove('show');
  });
});
document.querySelectorAll('[data-admin-tab]').forEach(function(btn){ btn.addEventListener('click',function(){ adminTab(this.dataset.adminTab); }); });
document.querySelectorAll('[data-jury-tab]').forEach(function(btn){ btn.addEventListener('click',function(){ juryTab(this.dataset.juryTab); }); });
document.querySelectorAll('.modal-close').forEach(function(btn){ btn.addEventListener('click',function(){ closeModal(this.dataset.close); }); });
document.querySelectorAll('.modal-overlay').forEach(function(o){ o.addEventListener('click',function(e){ if(e.target===this) this.classList.remove('open'); }); });

bootstrap().then(function(){
  if(window.__ME__){
    DB.currentUser = window.__ME__;
    if(DB.currentUser.role==='admin'){ showView('admin'); renderAdminSection('overview'); }
    else { showView('jury'); juryTab('projects'); renderJuryProjects(); }
  } else {
    renderPublic();
  }
});
})();
</script>
</body>
</html>
