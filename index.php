<?php
// Majaaz Portal - Production index.php
// All API calls go to api/ subdirectory
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl" id="root-html">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" id="csrf-meta" content="">
<title>مجاز ٢٠٢٦ — Majaaz 2026</title>
<link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><text y='.9em' font-size='90'>م</text></svg>">
<link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic:wght@400;500;600;700&family=Amiri:wght@400;700&family=IBM+Plex+Mono:wght@400;600&family=Playfair+Display:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>

/* ═══════════ TOKENS ═══════════ */
:root{
  --s0:#04070b;--s1:#080d14;--s2:#0d131c;--s3:#121a25;--s4:#18222f;--s5:#1f2c3c;
  --b1:rgba(255,255,255,.045);--b2:rgba(255,255,255,.08);--b3:rgba(255,255,255,.13);
  --t1:#edf2f7;--t2:#93a8bf;--t3:#506070;
  --cyan:#00d4b8;--cyan2:#00a896;--cg:rgba(0,212,184,.09);--cg2:rgba(0,212,184,.16);
  --gold:#d4a843;--gb:rgba(212,168,67,.1);
  --vi:#8b5cf6;--vb:rgba(139,92,246,.1);
  --gr:#22c55e;--grb:rgba(34,197,94,.1);
  --am:#f59e0b;--amb:rgba(245,158,11,.1);
  --re:#ef4444;--reb:rgba(239,68,68,.1);
  --bl:#3b82f6;--blb:rgba(59,130,246,.1);
  --rsm:6px;--rmd:10px;--rlg:14px;--rxl:18px;--r2xl:24px;
  --sh1:0 1px 4px rgba(0,0,0,.45);
  --sh2:0 4px 18px rgba(0,0,0,.55);
  --sh3:0 12px 42px rgba(0,0,0,.65);
  --sh4:0 24px 70px rgba(0,0,0,.75);
  --gcyan:0 0 28px rgba(0,212,184,.18);
  --sidebar-w:210px;
}
*{margin:0;padding:0;box-sizing:border-box;}
html{scroll-behavior:smooth;}
body{font-family:'Noto Naskh Arabic',serif;background:var(--s0);color:var(--t1);min-height:100vh;overflow-x:hidden;-webkit-font-smoothing:antialiased;}
body::before{content:'';position:fixed;inset:0;background-image:linear-gradient(var(--b1) 1px,transparent 1px),linear-gradient(90deg,var(--b1) 1px,transparent 1px);background-size:52px 52px;pointer-events:none;z-index:0;}
body::after{content:'';position:fixed;top:0;left:0;right:0;height:70vh;background:radial-gradient(ellipse 60% 60% at 25% -5%,rgba(0,212,184,.055),transparent),radial-gradient(ellipse 40% 40% at 80% 10%,rgba(139,92,246,.03),transparent);pointer-events:none;z-index:0;}
.view{display:none;position:relative;z-index:1;min-height:100vh;}
.view.active{display:block;}

/* ═══════════ TYPE ═══════════ */
.font-display{font-family:'Amiri',serif;}
.font-mono{font-family:'IBM Plex Mono',monospace;}

/* ═══════════ BUTTONS ═══════════ */
.btn{display:inline-flex;align-items:center;justify-content:center;gap:6px;padding:9px 18px;border-radius:var(--rmd);border:none;cursor:pointer;font-family:'Noto Naskh Arabic',serif;font-size:13px;font-weight:600;transition:all .18s ease;white-space:nowrap;}
.btn:active{transform:scale(.97);}
.btn-primary{background:var(--cyan);color:#04070b;font-weight:700;}
.btn-primary:hover{background:var(--cyan2);box-shadow:var(--gcyan);}
.btn-secondary{background:var(--s4);border:1px solid var(--b2);color:var(--t2);}
.btn-secondary:hover{border-color:var(--b3);color:var(--t1);background:var(--s5);}
.btn-ghost{background:transparent;color:var(--t3);border:1px solid var(--b2);}
.btn-ghost:hover{color:var(--t2);background:var(--s3);border-color:var(--b3);}
.btn-danger{background:var(--reb);border:1px solid rgba(239,68,68,.22);color:var(--re);}
.btn-danger:hover{background:rgba(239,68,68,.18);}
.btn-success{background:var(--grb);border:1px solid rgba(34,197,94,.22);color:var(--gr);}
.btn-save{background:var(--blb);border:1px solid rgba(59,130,246,.22);color:var(--bl);}
.btn-sm{padding:6px 13px;font-size:12px;border-radius:var(--rsm);}
.btn-lg{padding:13px 28px;font-size:15px;border-radius:var(--rlg);}
.btn-full{width:100%;}
.btn-icon{width:34px;height:34px;padding:0;border-radius:var(--rsm);}

/* ═══════════ FORM ═══════════ */
.field{margin-bottom:16px;}
.field-label{display:flex;align-items:center;gap:5px;font-size:12px;font-weight:600;color:var(--t2);margin-bottom:6px;}
.req{color:var(--re);}
.input{width:100%;background:var(--s3);border:1.5px solid var(--b2);border-radius:var(--rmd);padding:10px 13px;color:var(--t1);font-family:'Noto Naskh Arabic',serif;font-size:13px;outline:none;transition:border-color .18s,box-shadow .18s;}
.input:focus{border-color:var(--cyan);box-shadow:0 0 0 3px rgba(0,212,184,.1);}
.input::placeholder{color:var(--t3);}
.input.err{border-color:var(--re) !important;box-shadow:0 0 0 3px var(--reb);}
.input-note{font-size:11px;color:var(--t3);margin-top:4px;}
.input-note.warn{color:var(--am);}

/* ═══════════ BADGES ═══════════ */
.badge{display:inline-flex;align-items:center;gap:4px;padding:3px 8px;border-radius:20px;font-size:10px;font-weight:600;font-family:'IBM Plex Mono',monospace;white-space:nowrap;}
.badge::before{content:'';width:5px;height:5px;border-radius:50%;flex-shrink:0;}
.bg{background:var(--grb);color:var(--gr);border:1px solid rgba(34,197,94,.18);}.bg::before{background:var(--gr);}
.ba{background:var(--amb);color:var(--am);border:1px solid rgba(245,158,11,.18);}.ba::before{background:var(--am);}
.bb{background:var(--blb);color:var(--bl);border:1px solid rgba(59,130,246,.18);}.bb::before{background:var(--bl);}
.bv{background:var(--vb);color:var(--vi);border:1px solid rgba(139,92,246,.18);}.bv::before{background:var(--vi);}
.bc{background:var(--cg);color:var(--cyan);border:1px solid rgba(0,212,184,.18);}.bc::before{background:var(--cyan);}

/* ═══════════ CARD ═══════════ */
.card{background:var(--s2);border:1px solid var(--b1);border-radius:var(--rxl);}
.card-hd{padding:18px 20px 14px;border-bottom:1px solid var(--b1);display:flex;align-items:center;justify-content:space-between;gap:10px;}
.card-hd-title{font-family:'Amiri',serif;font-size:17px;font-weight:700;}
.card-bd{padding:18px 20px;}

/* ═══════════ DIVIDER ═══════════ */
.div{height:1px;background:var(--b1);margin:18px 0;}

/* ═══════════ SCROLLBAR ═══════════ */
::-webkit-scrollbar{width:4px;height:4px;}
::-webkit-scrollbar-track{background:transparent;}
::-webkit-scrollbar-thumb{background:var(--b3);border-radius:2px;}

/* ═══════════ TOAST ═══════════ */
.toast-root{position:fixed;bottom:22px;left:50%;transform:translateX(-50%);z-index:999;display:flex;flex-direction:column;gap:7px;pointer-events:none;align-items:center;}
.toast{background:var(--s4);border:1px solid var(--b3);color:var(--t1);padding:9px 16px;border-radius:var(--rlg);font-size:13px;box-shadow:var(--sh3);display:flex;align-items:center;gap:8px;min-width:220px;max-width:320px;animation:tIn .28s cubic-bezier(.34,1.56,.64,1);}
.toast-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0;}
.toast.ok .toast-dot{background:var(--gr);}
.toast.err .toast-dot{background:var(--re);}
@keyframes tIn{from{opacity:0;transform:translateY(14px) scale(.94)}to{opacity:1;transform:none}}

/* ═══════════ MODAL ═══════════ */
.overlay{position:fixed;inset:0;background:rgba(0,0,0,.78);backdrop-filter:blur(10px);z-index:500;display:none;align-items:center;justify-content:center;padding:16px;}
.overlay.open{display:flex;}
.modal{background:var(--s2);border:1px solid var(--b2);border-radius:var(--r2xl);width:100%;max-width:520px;max-height:94vh;overflow-y:auto;box-shadow:var(--sh4);animation:mIn .26s cubic-bezier(.34,1.56,.64,1);}
@keyframes mIn{from{opacity:0;transform:scale(.92) translateY(14px)}to{opacity:1;transform:none}}
.modal-hd{padding:20px 22px 16px;border-bottom:1px solid var(--b1);display:flex;align-items:center;justify-content:space-between;}
.modal-hd-title{font-family:'Amiri',serif;font-size:17px;font-weight:700;}
.modal-bd{padding:20px 22px;}
.modal-ft{padding:14px 22px;border-top:1px solid var(--b1);display:flex;gap:9px;}

/* ═══════════ PUBLIC NAV ═══════════ */
.pub-nav{display:flex;align-items:center;justify-content:space-between;padding:0 40px;height:60px;border-bottom:1px solid var(--b1);background:rgba(4,7,11,.88);backdrop-filter:blur(18px);position:sticky;top:0;z-index:300;}
.brand{display:flex;align-items:center;gap:11px;cursor:pointer;}
.brand-icon{width:36px;height:36px;background:#000;border:1px solid rgba(0,212,184,.28);border-radius:9px;display:flex;align-items:center;justify-content:center;overflow:hidden;padding:2px;}
.brand-name{font-family:'Amiri',serif;font-size:17px;font-weight:700;}
.brand-sub{font-family:'IBM Plex Mono',monospace;font-size:8px;color:var(--cyan);letter-spacing:.16em;display:block;margin-top:-2px;opacity:.8;}

/* ═══════════ PUBLIC HERO ═══════════ */
.hero{padding:64px 40px 48px;max-width:700px;margin:0 auto;text-align:center;}
.hero-pill{display:inline-flex;align-items:center;gap:7px;background:var(--cg);border:1px solid rgba(0,212,184,.18);border-radius:20px;padding:5px 14px;font-size:11px;color:var(--cyan);font-weight:600;letter-spacing:.05em;margin-bottom:20px;}
.hero-pill-dot{width:6px;height:6px;border-radius:50%;background:var(--cyan);animation:pulse 2s infinite;}
@keyframes pulse{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(.8)}}
.hero-title{font-family:'Amiri',serif;font-size:clamp(28px,5.5vw,54px);font-weight:700;line-height:1.15;background:linear-gradient(145deg,#fff 25%,var(--cyan) 62%,var(--gold) 100%);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;margin-bottom:14px;}
.hero-sub{color:var(--t2);font-size:15px;line-height:1.8;margin-bottom:36px;}
/* KPI strip */
.kpi-strip{display:flex;justify-content:center;gap:0;background:var(--s2);border:1px solid var(--b2);border-radius:var(--rxl);overflow:hidden;max-width:420px;margin:0 auto 52px;}
.kpi-item{flex:1;padding:18px 12px;text-align:center;border-left:1px solid var(--b1);}
.kpi-item:last-child{border-left:none;}
.kpi-num{font-family:'IBM Plex Mono',monospace;font-size:24px;font-weight:600;color:var(--cyan);display:block;line-height:1;margin-bottom:4px;}
.kpi-label{font-size:11px;color:var(--t3);}

/* ═══════════ PUB SECTION ═══════════ */
.pub-section{padding:0 40px 80px;}
.sec-bar{display:flex;align-items:center;justify-content:space-between;margin-bottom:22px;}
.sec-heading{font-family:'Amiri',serif;font-size:19px;font-weight:700;display:flex;align-items:center;gap:9px;}
.sec-heading::before{content:'';width:3px;height:20px;background:var(--cyan);border-radius:2px;flex-shrink:0;}
.pub-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:18px;}

/* pub card */
.pub-card{background:var(--s2);border:1px solid var(--b1);border-radius:var(--rxl);overflow:hidden;cursor:pointer;transition:border-color .25s,transform .25s,box-shadow .25s;}
.pub-card:hover{border-color:var(--b3);transform:translateY(-5px);box-shadow:var(--sh3),0 0 32px rgba(0,212,184,.06);}
.pub-card-img{position:relative;overflow:hidden;}
.pub-card-img img{width:100%;height:200px;object-fit:cover;display:block;transition:transform .45s ease;}
.pub-card:hover .pub-card-img img{transform:scale(1.06);}
.pub-card-ph{width:100%;height:200px;background:linear-gradient(140deg,var(--s3),var(--s4));display:flex;align-items:center;justify-content:center;font-size:38px;color:var(--t3);}
.pub-card-grad{position:absolute;inset:0;background:linear-gradient(to top,rgba(4,7,11,.72),transparent 55%);opacity:0;transition:opacity .25s;}
.pub-card:hover .pub-card-grad{opacity:1;}
.pub-card-cta{position:absolute;bottom:12px;right:50%;transform:translateX(50%);background:var(--cyan);color:#04070b;border:none;border-radius:var(--rsm);padding:7px 16px;font-family:'Noto Naskh Arabic',serif;font-size:12px;font-weight:700;cursor:pointer;opacity:0;transition:opacity .25s;white-space:nowrap;}
.pub-card:hover .pub-card-cta{opacity:1;}
.img-chip{position:absolute;top:9px;left:9px;background:rgba(4,7,11,.72);backdrop-filter:blur(6px);border:1px solid var(--b2);border-radius:20px;padding:3px 9px;font-family:'IBM Plex Mono',monospace;font-size:10px;color:var(--t2);}
.pub-card-body{padding:14px 16px;}
.pub-card-name{font-family:'Amiri',serif;font-size:16px;font-weight:700;margin-bottom:8px;}
.pub-card-foot{display:flex;align-items:center;justify-content:space-between;}

/* ═══════════ PROJECT DETAIL ═══════════ */
.d-hero{height:420px;position:relative;overflow:hidden;cursor:pointer;}
.d-hero img{width:100%;height:100%;object-fit:cover;transition:transform .4s ease;}
.d-hero:hover img{transform:scale(1.03);}
.d-hero-ph{width:100%;height:100%;background:linear-gradient(140deg,var(--s3),var(--s4));display:flex;align-items:center;justify-content:center;font-size:72px;color:var(--t3);}
.d-hero-grad{position:absolute;inset:0;background:linear-gradient(to top,var(--s0) 0%,transparent 55%);}
.d-hero-info{position:absolute;bottom:26px;right:40px;left:40px;}
.d-hero-info h1{font-family:'Amiri',serif;font-size:clamp(20px,4vw,38px);font-weight:700;margin-bottom:9px;}
.d-body{padding:32px 40px 80px;}
.gal-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(210px,1fr));gap:12px;}
.gal-item{border-radius:var(--rlg);overflow:hidden;cursor:pointer;border:1px solid var(--b1);transition:border-color .2s,transform .2s,box-shadow .2s;}
.gal-item:hover{border-color:var(--cyan);transform:translateY(-3px);box-shadow:var(--sh2);}
.gal-item img{width:100%;height:155px;object-fit:cover;display:block;}
.gal-item-desc{padding:8px 10px;font-size:12px;color:var(--t2);line-height:1.5;background:var(--s2);border-top:1px solid var(--b1);}
/* eval result */
.er{background:var(--s2);border:1px solid var(--b1);border-radius:var(--rxl);padding:20px;margin-bottom:14px;}
.er-hd{display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:14px;padding-bottom:12px;border-bottom:1px solid var(--b1);}
.er-name{font-family:'Amiri',serif;font-size:15px;font-weight:700;}
.er-score-big{font-family:'IBM Plex Mono',monospace;font-size:26px;color:var(--cyan);font-weight:600;line-height:1;}
.er-score-norm{font-family:'IBM Plex Mono',monospace;font-size:11px;color:var(--gold);margin-top:2px;}
.er-bar{height:3px;background:var(--s4);border-radius:2px;overflow:hidden;margin-bottom:14px;}
.er-bar-fill{height:100%;background:linear-gradient(90deg,var(--cyan2),var(--cyan));border-radius:2px;}
.er-crit-grid{display:grid;grid-template-columns:1fr 1fr;gap:7px;margin-bottom:12px;}
.er-crit{background:var(--s3);border-radius:var(--rsm);padding:9px 11px;display:flex;align-items:center;justify-content:space-between;gap:8px;}
.er-crit-lbl{font-size:11px;color:var(--t2);flex:1;line-height:1.4;}
.er-crit-val{font-family:'IBM Plex Mono',monospace;font-size:13px;color:var(--cyan);font-weight:600;flex-shrink:0;}
.er-comment{background:var(--s3);border-right:3px solid var(--cyan);border-radius:0 var(--rsm) var(--rsm) 0;padding:11px 13px;font-size:13px;color:var(--t2);font-style:italic;line-height:1.7;}

/* ═══════════ AUTH ═══════════ */
#view-auth{display:flex;align-items:center;justify-content:center;min-height:100vh;padding:40px 20px;position:relative;}
/* subtle radial behind auth card */
#view-auth::before{content:'';position:absolute;inset:0;background:radial-gradient(ellipse 70% 70% at 50% 50%,rgba(0,212,184,.04),transparent);pointer-events:none;}
.auth-card{background:var(--s2);border:1px solid var(--b2);border-radius:var(--r2xl);padding:34px;width:100%;max-width:390px;box-shadow:var(--sh4);position:relative;overflow:hidden;}
.auth-card::before{content:'';position:absolute;top:0;left:12%;right:12%;height:1px;background:linear-gradient(90deg,transparent,var(--cyan),transparent);}
.auth-tabs{display:flex;background:var(--s3);border-radius:var(--rmd);padding:3px;gap:3px;margin-bottom:22px;}
.auth-tab{flex:1;padding:8px;border-radius:var(--rsm);border:none;background:transparent;color:var(--t3);cursor:pointer;font-family:'Noto Naskh Arabic',serif;font-size:13px;font-weight:600;transition:all .18s;}
.auth-tab.active{background:var(--s5);color:var(--t1);box-shadow:var(--sh1);}
.auth-err{background:var(--reb);border:1px solid rgba(239,68,68,.22);color:var(--re);border-radius:var(--rmd);padding:9px 13px;font-size:12px;margin-bottom:14px;display:none;align-items:center;gap:7px;}
.auth-err.show{display:flex;}
.auth-hint{text-align:center;font-size:11px;color:var(--t3);margin-top:12px;background:var(--s3);border-radius:var(--rsm);padding:7px;}

/* ═══════════ SHELL / SIDEBAR ═══════════ */
.shell{display:flex;min-height:100vh;}
.sbar{width:var(--sidebar-w);background:var(--s1);border-left:1px solid var(--b1);display:flex;flex-direction:column;position:fixed;top:0;right:0;bottom:0;z-index:200;overflow-y:auto;}
.sbar-top{padding:14px 14px 12px;border-bottom:1px solid var(--b1);}
.sbar-brand{display:flex;align-items:center;gap:9px;}
.sbar-icon{width:32px;height:32px;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;overflow:hidden;background:#000;padding:2px;}
.sbar-icon.admin{background:var(--vb);border:1px solid rgba(139,92,246,.25);color:var(--vi);}
.sbar-icon.jury{background:var(--gb);border:1px solid rgba(212,168,67,.25);color:var(--gold);}
.sbar-brand-name{font-family:'Amiri',serif;font-size:14px;font-weight:700;}
.sbar-brand-sub{font-family:'IBM Plex Mono',monospace;font-size:8px;letter-spacing:.12em;display:block;margin-top:-1px;}
.sbar-brand-sub.admin{color:var(--vi);}
.sbar-brand-sub.jury{color:var(--gold);}
.sbar-sec{padding:10px 8px 4px;}
.sbar-sec-lbl{font-size:10px;font-weight:600;color:var(--t3);letter-spacing:.07em;text-transform:uppercase;padding:0 6px;margin-bottom:3px;}
.nav-btn{display:flex;align-items:center;gap:9px;width:100%;padding:8px 9px;border:none;background:transparent;color:var(--t2);cursor:pointer;border-radius:var(--rsm);font-family:'Noto Naskh Arabic',serif;font-size:13px;font-weight:500;transition:all .16s;text-align:right;}
.nav-btn:hover{background:var(--s3);color:var(--t1);}
.nav-btn.active{background:var(--cg);color:var(--cyan);}
.nav-btn.active.jury-role{background:var(--gb);color:var(--gold);}
.nav-icon{width:26px;height:26px;border-radius:6px;background:var(--s3);display:flex;align-items:center;justify-content:center;font-size:12px;flex-shrink:0;transition:background .16s;}
.nav-btn.active .nav-icon{background:var(--cg2);}
.nav-btn.active.jury-role .nav-icon{background:var(--gb);}
.sbar-foot{margin-top:auto;padding:10px 8px;border-top:1px solid var(--b1);}
.user-row{display:flex;align-items:center;gap:9px;padding:9px 10px;background:var(--s3);border-radius:var(--rsm);margin-bottom:8px;border:1px solid var(--b1);}
.user-av{width:28px;height:28px;border-radius:6px;display:flex;align-items:center;justify-content:center;font-family:'IBM Plex Mono',monospace;font-size:11px;font-weight:600;flex-shrink:0;}
.user-av.admin{background:var(--vb);color:var(--vi);}
.user-av.jury{background:var(--gb);color:var(--gold);}
.user-info-name{font-size:12px;font-weight:600;line-height:1.2;}
.user-info-role{font-size:10px;color:var(--t3);margin-top:1px;}
.main{flex:1;margin-right:var(--sidebar-w);padding:28px 32px;min-height:100vh;}
.ph{margin-bottom:24px;}
.ph-title{font-family:'Amiri',serif;font-size:21px;font-weight:700;margin-bottom:2px;}
.ph-sub{font-size:12px;color:var(--t3);}
.dash-tab{display:none;}.dash-tab.active{display:block;}

/* stat strip */
.stat-strip{display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-bottom:24px;}
.stat-box{background:var(--s2);border:1px solid var(--b1);border-radius:var(--rlg);padding:16px 14px;display:flex;align-items:center;gap:12px;transition:border-color .2s;}
.stat-box:hover{border-color:var(--b2);}
.stat-icon{width:38px;height:38px;border-radius:var(--rsm);display:flex;align-items:center;justify-content:center;font-size:17px;flex-shrink:0;}
.stat-num{font-family:'IBM Plex Mono',monospace;font-size:21px;font-weight:600;line-height:1;margin-bottom:2px;}
.stat-num.zero{color:var(--t3);}
.stat-lbl{font-size:11px;color:var(--t3);}

/* table */
.tbl-wrap{border-radius:var(--rlg);border:1px solid var(--b1);overflow:hidden;}
.tbl{width:100%;border-collapse:collapse;}
.tbl th{text-align:right;font-size:10px;font-weight:600;letter-spacing:.06em;text-transform:uppercase;color:var(--t3);padding:10px 14px;background:var(--s3);border-bottom:1px solid var(--b1);}
.tbl td{padding:11px 14px;font-size:13px;border-bottom:1px solid var(--b1);color:var(--t1);vertical-align:middle;}
.tbl tr:last-child td{border-bottom:none;}
.tbl tbody tr:hover td{background:rgba(255,255,255,.012);}

/* proj grid */
.proj-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:14px;}
.pc{background:var(--s2);border:1px solid var(--b1);border-radius:var(--rxl);overflow:hidden;transition:border-color .2s,box-shadow .2s;}
.pc:hover{border-color:var(--b2);box-shadow:var(--sh2);}
.pc-img img{width:100%;height:135px;object-fit:cover;display:block;}
.pc-img-ph{width:100%;height:135px;background:linear-gradient(140deg,var(--s3),var(--s4));display:flex;align-items:center;justify-content:center;font-size:30px;color:var(--t3);}
.pc-body{padding:12px 14px;}
.pc-name{font-family:'Amiri',serif;font-size:14px;font-weight:700;margin-bottom:5px;}
.pc-meta{display:flex;align-items:center;justify-content:space-between;font-size:11px;color:var(--t3);margin-bottom:10px;}
.pc-acts{display:flex;gap:6px;}

/* upload */
.upload-zone{border:2px dashed var(--b2);border-radius:var(--rlg);padding:20px;text-align:center;cursor:pointer;transition:all .18s;background:var(--s3);}
.upload-zone:hover{border-color:var(--cyan);background:var(--cg);}
.uz-icon{font-size:22px;margin-bottom:5px;opacity:.45;}
.uz-text{font-size:13px;color:var(--t2);}
.uz-sub{font-size:11px;color:var(--t3);margin-top:2px;}
.img-item{display:flex;gap:9px;align-items:flex-start;background:var(--s3);border:1px solid var(--b1);border-radius:var(--rmd);padding:9px;}
.img-item-th{width:60px;height:60px;object-fit:cover;border-radius:var(--rsm);flex-shrink:0;}
.img-item-body{flex:1;min-width:0;}
.img-item-name{font-size:11px;color:var(--cyan);margin-bottom:4px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;}

/* ═══════════ EVAL FULLSCREEN ═══════════ */
#view-eval-fullscreen{background:var(--s0);}
.eval-nav{display:flex;align-items:center;justify-content:space-between;padding:0 28px;height:54px;border-bottom:1px solid var(--b1);background:rgba(4,7,11,.92);backdrop-filter:blur(14px);position:sticky;top:0;z-index:200;}
.eval-nav-title{font-family:'Amiri',serif;font-size:15px;font-weight:700;}
.eval-nav-sub{font-size:10px;color:var(--cyan);font-family:'IBM Plex Mono',monospace;margin-top:1px;}
/* back btn with arrow visibility */
.back-btn{display:flex;align-items:center;gap:7px;padding:7px 14px;border-radius:var(--rsm);border:1px solid var(--b2);background:var(--s3);color:var(--t2);cursor:pointer;font-family:'Noto Naskh Arabic',serif;font-size:12px;font-weight:600;transition:all .18s;}
.back-btn:hover{border-color:var(--b3);color:var(--t1);background:var(--s4);}
.back-btn-arrow{font-size:14px;color:var(--cyan);}

/* carousel */
.car-outer{background:#000;position:relative;overflow:hidden;height:58vh;cursor:grab;}
.car-outer.zoomed{cursor:move;}
.car-viewport{position:relative;width:100%;height:100%;display:flex;align-items:center;justify-content:center;overflow:hidden;}
.car-img{position:absolute;max-width:100%;max-height:100%;object-fit:contain;user-select:none;-webkit-user-drag:none;display:block;transition:opacity .3s ease;}
.car-img.hidden{opacity:0;pointer-events:none;}
.car-slide-ph{font-size:64px;opacity:.1;}
.car-arrow{position:absolute;top:50%;transform:translateY(-50%);width:38px;height:38px;border-radius:50%;background:rgba(8,13,20,.82);backdrop-filter:blur(8px);border:1px solid var(--b2);color:var(--t1);font-size:15px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .18s;z-index:10;}
.car-arrow:hover{border-color:var(--cyan);color:var(--cyan);}
.car-arrow:disabled{opacity:.2;cursor:not-allowed;pointer-events:none;}
.car-ap{right:12px;}
.car-an{left:12px;}
.car-count{position:absolute;bottom:9px;left:50%;transform:translateX(-50%);background:rgba(8,13,20,.72);backdrop-filter:blur(6px);border:1px solid var(--b2);border-radius:20px;padding:3px 11px;font-family:'IBM Plex Mono',monospace;font-size:10px;color:var(--cyan);}
/* zoom — visually connected to carousel via shared border */
.zoom-bar{display:flex;align-items:center;justify-content:center;gap:8px;padding:8px 18px;background:var(--s2);border-top:2px solid var(--s4);}
.z-btn{width:30px;height:30px;border-radius:var(--rsm);background:var(--s3);border:1px solid var(--b2);color:var(--t1);font-size:16px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:all .16s;flex-shrink:0;}
.z-btn:hover{border-color:var(--cyan);color:var(--cyan);}
.z-pct{font-family:'IBM Plex Mono',monospace;font-size:12px;color:var(--cyan);min-width:44px;text-align:center;font-weight:600;}
.z-reset{font-size:11px;padding:5px 11px;height:30px;width:auto;white-space:nowrap;background:var(--s3);border:1px solid var(--b2);color:var(--t2);border-radius:var(--rsm);cursor:pointer;font-family:'Noto Naskh Arabic',serif;transition:all .16s;}
.z-reset:hover{border-color:var(--b3);color:var(--t1);}
/* scroll hint */
.scroll-hint{display:flex;align-items:center;justify-content:center;gap:6px;padding:7px;background:var(--s1);border-top:1px solid var(--b1);font-size:11px;color:var(--t3);cursor:pointer;transition:color .16s;}
.scroll-hint:hover{color:var(--t2);}
.scroll-hint-arrow{animation:bounce 1.6s infinite;}
@keyframes bounce{0%,100%{transform:translateY(0)}50%{transform:translateY(3px)}}
@keyframes successPop{0%{transform:scale(0) rotate(-20deg);opacity:0}60%{transform:scale(1.2) rotate(4deg);opacity:1}100%{transform:scale(1) rotate(0deg);opacity:1}}
@keyframes successFade{0%{opacity:1;transform:scale(1)}100%{opacity:0;transform:scale(1.08)}}
.login-success-overlay{position:fixed;inset:0;z-index:9999;display:flex;align-items:center;justify-content:center;background:rgba(4,7,11,.85);backdrop-filter:blur(6px);}
.login-success-box{display:flex;flex-direction:column;align-items:center;gap:14px;animation:successPop .45s cubic-bezier(.34,1.56,.64,1) forwards;}
.login-success-icon{width:80px;height:80px;border-radius:50%;background:rgba(0,212,184,.15);border:2px solid var(--cyan);display:flex;align-items:center;justify-content:center;font-size:36px;}
.login-success-text{font-family:'Amiri',serif;font-size:22px;font-weight:700;color:var(--cyan);}
.login-success-sub{font-size:13px;color:var(--t2);}
/* desc bar */
.car-desc{padding:8px 22px;font-size:12px;color:var(--t2);line-height:1.6;background:var(--s1);border-top:1px solid var(--b1);min-height:36px;display:flex;align-items:center;gap:7px;}
.car-desc-icon{color:var(--cyan);flex-shrink:0;font-size:12px;}
/* thumbs */
.car-thumbs{display:flex;gap:6px;padding:8px 16px;background:var(--s2);border-top:1px solid var(--b1);overflow-x:auto;}
.car-th{width:48px;height:48px;object-fit:cover;border-radius:var(--rsm);cursor:pointer;border:2px solid transparent;transition:all .16s;flex-shrink:0;opacity:.4;}
.car-th.active{border-color:var(--cyan);opacity:1;}
.car-th:hover{opacity:.75;}

/* eval form */
.eval-form{padding:32px 40px 80px;max-width:820px;margin:0 auto;}
.ef-title{font-family:'Amiri',serif;font-size:19px;font-weight:700;display:flex;align-items:center;gap:9px;margin-bottom:3px;}
.ef-title::before{content:'';width:3px;height:21px;background:var(--cyan);border-radius:2px;flex-shrink:0;}
.ef-sub{font-size:12px;color:var(--t3);margin-bottom:22px;}
.prog-row{display:flex;align-items:center;gap:11px;padding:9px 13px;background:var(--s2);border:1px solid var(--b1);border-radius:var(--rmd);margin-bottom:16px;}
.prog-bar{flex:1;height:3px;background:var(--s4);border-radius:2px;overflow:hidden;}
.prog-fill{height:100%;background:linear-gradient(90deg,var(--cyan2),var(--cyan));border-radius:2px;transition:width .3s ease;}
.prog-txt{font-family:'IBM Plex Mono',monospace;font-size:11px;color:var(--cyan);white-space:nowrap;}
.score-live{text-align:center;padding:13px;background:var(--s2);border:1px solid var(--b1);border-radius:var(--rlg);margin-bottom:18px;}
.sl-big{font-family:'IBM Plex Mono',monospace;font-size:30px;font-weight:600;color:var(--cyan);line-height:1;}
.sl-norm{font-family:'IBM Plex Mono',monospace;font-size:12px;color:var(--gold);display:block;margin-top:3px;}
.sl-lbl{font-size:11px;color:var(--t3);margin-top:2px;}
.lk-card{background:var(--s2);border:1.5px solid var(--b1);border-radius:var(--rlg);padding:14px 16px;margin-bottom:10px;transition:border-color .2s;}
.lk-card.done{border-color:rgba(0,212,184,.22);}
.lk-q{font-size:13px;font-weight:500;color:var(--t1);margin-bottom:10px;line-height:1.6;display:flex;gap:8px;}
.lk-qn{font-family:'IBM Plex Mono',monospace;font-size:11px;color:var(--cyan);flex-shrink:0;margin-top:2px;}
.lk-scale{display:flex;gap:5px;}
.lk-opt{flex:1;padding:8px 3px;border-radius:var(--rsm);border:1px solid var(--b2);background:var(--s3);color:var(--t3);cursor:pointer;font-family:'Noto Naskh Arabic',serif;font-size:10px;font-weight:500;transition:all .16s;text-align:center;line-height:1.4;}
.lk-opt:hover{border-color:var(--cyan);color:var(--cyan);background:var(--cg);}
.lk-opt.sel{background:var(--cyan);border-color:var(--cyan);color:#04070b;font-weight:700;}
.lk-v{display:none;}
.comment-section{background:var(--s2);border:1px solid var(--b1);border-radius:var(--rlg);padding:16px;margin-top:6px;}
.comment-section .field-label{font-size:13px;color:var(--t1);margin-bottom:8px;}
.comment-req-note{font-size:11px;color:var(--am);margin-bottom:8px;display:flex;align-items:center;gap:5px;}
.eval-actions{display:flex;gap:9px;margin-top:18px;}
.eval-actions .btn{flex:1;padding:12px;}
.pub-banner{background:var(--grb);border:1px solid rgba(34,197,94,.18);border-radius:var(--rlg);padding:12px 16px;display:flex;align-items:center;gap:9px;font-size:13px;color:var(--gr);font-weight:600;margin-bottom:16px;}

/* ═══════════ EMPTY STATES ═══════════ */
.empty{text-align:center;padding:52px 28px;color:var(--t3);}
.empty-icon{font-size:40px;display:block;margin-bottom:12px;opacity:.2;}
.empty-title{font-family:'Amiri',serif;font-size:15px;color:var(--t2);margin-bottom:5px;}
.empty-sub{font-size:12px;}

/* ═══════════ LIGHTBOX ═══════════ */
.lb{position:fixed;inset:0;background:rgba(0,0,0,.97);z-index:700;display:none;flex-direction:column;}
.lb.open{display:flex;}
.lb-top{display:flex;align-items:center;justify-content:space-between;padding:11px 16px;flex-shrink:0;border-bottom:1px solid rgba(255,255,255,.06);}
.lb-top-title{font-family:'Amiri',serif;font-size:14px;}
.lb-top-right{display:flex;align-items:center;gap:9px;}
.lb-count{font-family:'IBM Plex Mono',monospace;font-size:11px;color:rgba(255,255,255,.35);}
.lb-x{width:30px;height:30px;border-radius:50%;background:rgba(255,255,255,.07);border:1px solid rgba(255,255,255,.1);color:#fff;font-size:13px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .18s;}
.lb-x:hover{background:rgba(255,255,255,.16);}
.lb-body{display:flex;flex:1;min-height:0;}
.lb-side{width:240px;background:rgba(8,13,20,.95);border-right:1px solid rgba(255,255,255,.06);padding:16px;overflow-y:auto;flex-shrink:0;}
.lb-side-lbl{font-size:10px;color:var(--cyan);font-family:'IBM Plex Mono',monospace;letter-spacing:.1em;text-transform:uppercase;margin-bottom:7px;}
.lb-side-txt{font-size:13px;color:var(--t1);line-height:1.75;}
.lb-img-wrap{flex:1;display:flex;align-items:center;justify-content:center;padding:10px;position:relative;}
.lb-img{max-width:100%;max-height:100%;object-fit:contain;border-radius:7px;}
.lb-arr{position:absolute;top:50%;transform:translateY(-50%);width:38px;height:38px;border-radius:50%;background:rgba(255,255,255,.06);border:1px solid rgba(255,255,255,.1);color:#fff;font-size:15px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:background .18s;}
.lb-arr:hover{background:rgba(255,255,255,.15);}
.lb-arr-p{right:11px;}
.lb-arr-n{left:11px;}
.lb-thumbs{display:flex;gap:5px;padding:7px 13px;background:rgba(8,13,20,.8);border-top:1px solid rgba(255,255,255,.05);overflow-x:auto;flex-shrink:0;}
.lb-th{width:46px;height:46px;object-fit:cover;border-radius:5px;cursor:pointer;border:2px solid transparent;transition:all .16s;flex-shrink:0;opacity:.45;}
.lb-th.active{border-color:var(--cyan);opacity:1;}

/* ═══════════ RESPONSIVE ═══════════ */
@media(max-width:960px){
  :root{--sidebar-w:0px;}
  .sbar{width:100%;position:relative;height:auto;flex-direction:row;flex-wrap:wrap;}
  .sbar-top{width:100%;border-bottom:1px solid var(--b1);border-left:none;}
  .sbar-sec{display:flex;gap:4px;padding:8px;width:100%;}
  .sbar-sec-lbl{display:none;}
  .nav-btn{flex:1;justify-content:center;padding:8px 6px;font-size:11px;}
  .nav-icon{display:none;}
  .sbar-foot{width:100%;flex-direction:row;align-items:center;gap:8px;padding:8px;}
  .user-row{flex:1;margin-bottom:0;}
  .main{margin-right:0;padding:18px 16px;}
  .stat-strip{grid-template-columns:1fr 1fr;}
  .hero{padding:40px 20px 32px;}
  .pub-nav,.pub-section,.d-hero-info,.d-body{padding-left:20px;padding-right:20px;}
  .pub-section{padding-bottom:48px;}
  .kpi-strip{flex-direction:column;max-width:100%;}
  .kpi-item{border-left:none;border-bottom:1px solid var(--b1);}
  .kpi-item:last-child{border-bottom:none;}
  .d-hero{height:260px;}
  .er-crit-grid{grid-template-columns:1fr;}
  .eval-form{padding:20px 16px 60px;}
  .lk-scale{flex-wrap:wrap;}
  .lk-opt{min-width:calc(50% - 3px);}
  .lb-side{display:none;}
  .car-slide{max-height:42vh;}
  .car-slide img{max-height:42vh;}
  .eval-nav{padding:0 14px;}
}
@media(max-width:480px){
  .pub-grid{grid-template-columns:1fr;}
  .proj-grid,.pc{grid-template-columns:1fr;}
  .stat-strip{grid-template-columns:1fr;}
  .auth-card{padding:24px 18px;}
  .eval-actions{flex-direction:column;}
  .modal-ft{flex-direction:column;}
  .modal-ft .btn{width:100%;}
}


/* ═══════════ i18n OVERRIDES ═══════════ */
[lang="en"] body { font-family: 'Inter', 'Segoe UI', sans-serif; }
[lang="en"] .font-display, [lang="en"] .brand-name, [lang="en"] .card-hd-title,
[lang="en"] .modal-hd-title, [lang="en"] .hero-title, [lang="en"] .sec-heading,
[lang="en"] .ef-title, [lang="en"] .ph-title, [lang="en"] .empty-title,
[lang="en"] .sbar-brand-name, [lang="en"] .eval-nav-title,
[lang="en"] .d-hero-info h1, [lang="en"] .pub-card-name, [lang="en"] .pc-name {
  font-family: 'Playfair Display', serif;
}
[lang="en"] .auth-tab, [lang="en"] .nav-btn, [lang="en"] .btn {
  font-family: 'Inter', sans-serif;
}
[lang="en"] .er-comment { border-right: none; border-left: 3px solid var(--cyan); }
[lang="en"] .tbl th { text-align: left; }
[lang="en"] .tbl td { text-align: left; }
[lang="en"] .sec-heading::before { margin-right: 0; margin-left: 0; }
[lang="en"] .sbar { border-left: none; border-right: 1px solid var(--b1); right: auto; left: 0; }
[lang="en"] .main { margin-right: 0; margin-left: var(--sidebar-w); }
[lang="en"] .img-chip { left: auto; right: 9px; }
[lang="en"] .nav-btn { text-align: left; }
[lang="en"] .car-ap { right: auto; left: 12px; }
[lang="en"] .car-an { left: auto; right: 12px; }
[lang="en"] .lb-arr-p { right: auto; left: 11px; }
[lang="en"] .lb-arr-n { left: auto; right: 11px; }
[lang="en"] .lb-side { border-right: none; border-left: 1px solid rgba(255,255,255,.06); }
[lang="en"] .auth-card::before { left: 12%; right: 12%; }
[lang="en"] .pub-banner { flex-direction: row; }

/* Language toggle button */
.lang-toggle {
  display: flex; align-items: center; gap: 5px;
  background: var(--s3); border: 1px solid var(--b2);
  border-radius: 20px; padding: 4px 12px;
  cursor: pointer; font-size: 12px; font-weight: 600;
  color: var(--t2); transition: all .18s;
  font-family: 'IBM Plex Mono', monospace; letter-spacing: .04em;
}
.lang-toggle:hover { border-color: var(--cyan); color: var(--cyan); }
.lang-toggle .lf { font-size: 14px; }

@media(max-width:960px){
  [lang="en"] .sbar { left: 0; right: 0; }
  [lang="en"] .main { margin-left: 0; }
}

</style>
</head>
<body>

<!-- ══ LOADING OVERLAY ══ -->
<div id="app-loading" style="position:fixed;inset:0;z-index:9999;background:var(--s0);display:flex;flex-direction:column;align-items:center;justify-content:center;gap:16px;">
  <div style="width:42px;height:42px;border:3px solid var(--b2);border-top-color:var(--cyan);border-radius:50%;animation:spin .7s linear infinite;"></div>
  <div style="font-family:'IBM Plex Mono',monospace;font-size:12px;color:var(--t3);letter-spacing:.1em;">MAJAAZ 2026</div>
</div>
<style>@keyframes spin{to{transform:rotate(360deg)}}</style>

<!-- ══ PUBLIC ══ -->
<div id="view-public" class="view active">
  <nav class="pub-nav">
    <div class="brand" id="logo-home">
      <div class="brand-icon"><img src="data:image/png;base64,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" style="width:100%;height:100%;object-fit:contain;"></div>
      <div><div class="brand-name" data-i18n="brand">مجاز</div><span class="brand-sub">MAJAAZ 2026</span></div>
    </div>
    <div style="display:flex;align-items:center;gap:10px;">
      <button class="lang-toggle" id="lang-btn">
        <span class="lf">🌐</span><span id="lang-label">EN</span>
      </button>
      <button class="btn btn-secondary btn-sm" id="btn-go-auth" data-i18n="nav_login">🔐 دخول المحكّمين</button>
    </div>
  </nav>
  <div class="hero">
    <div class="hero-pill"><span class="hero-pill-dot"></span><span data-i18n="hero_pill">مسابقة معمارية · العراق ٢٠٢٦</span></div>
    <h1 class="hero-title" data-i18n="hero_title">بوابة تقييم مسابقة<br>مجاز المعمارية</h1>
    <p class="hero-sub" data-i18n="hero_sub">استعرض المشاريع المشاركة واطّلع على تقييمات لجنة التحكيم</p>
    <div class="kpi-strip">
      <div class="kpi-item"><span class="kpi-num" id="pub-total">0</span><div class="kpi-label" data-i18n="kpi_projects">مشروع</div></div>
      <div class="kpi-item"><span class="kpi-num" id="pub-evaluated">0</span><div class="kpi-label" data-i18n="kpi_evaluated">مُقيَّم</div></div>
      <div class="kpi-item"><span class="kpi-num" id="pub-evals-count">0</span><div class="kpi-label" data-i18n="kpi_published">تقييم منشور</div></div>
    </div>
  </div>
  <section class="pub-section">
    <div class="sec-bar"><div class="sec-heading" data-i18n="all_projects">جميع المشاريع</div></div>
    <div class="pub-grid" id="pub-grid"></div>
    <div class="empty" id="pub-empty" style="display:none;">
      <span class="empty-icon">🏛</span>
      <div class="empty-title" data-i18n="no_projects">لا توجد مشاريع بعد</div>
      <p class="empty-sub" data-i18n="no_projects_sub">ستظهر المشاريع بعد رفعها من قِبل الإدارة</p>
    </div>
  </section>
</div>

<!-- ══ DETAIL ══ -->
<div id="view-project-detail" class="view">
  <nav class="pub-nav">
    <div class="brand" id="detail-logo-home">
      <div class="brand-icon"><img src="data:image/png;base64,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" style="width:100%;height:100%;object-fit:contain;"></div>
      <div><div class="brand-name">مجاز</div><span class="brand-sub">MAJAAZ 2026</span></div>
    </div>
    <button class="back-btn" id="detail-back"><span class="back-btn-arrow">←</span> <span data-i18n="back_projects">العودة للمشاريع</span></button>
  </nav>
  <div id="detail-content"></div>
</div>

<!-- ══ AUTH ══ -->
<div id="view-auth" class="view">
  <button class="back-btn" style="position:fixed;top:14px;right:14px;z-index:10;" id="btn-back-public">
    <span class="back-btn-arrow">←</span> <span data-i18n="back">العودة</span>
  </button>
  <div class="auth-card" style="animation:mIn .3s ease;">
    <div style="text-align:center;margin-bottom:24px;">
      <div class="brand-icon" style="width:48px;height:48px;margin:0 auto 10px;background:#000;border-radius:9px;overflow:hidden;padding:3px;">
        <img src="data:image/png;base64,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" style="width:100%;height:100%;object-fit:contain;">
      </div>
      <div style="font-family:'Amiri',serif;font-size:19px;font-weight:700;margin-bottom:2px;" data-i18n="auth_title">مجاز ٢٠٢٦</div>
      <div style="font-family:'IBM Plex Mono',monospace;font-size:9px;color:var(--cyan);letter-spacing:.15em;">MAJAAZ ARCHITECTURAL COMPETITION</div>
    </div>
    <div class="auth-err" id="auth-error">⚠️ <span data-i18n="auth_error">البريد الإلكتروني أو كلمة المرور غير صحيحة</span></div>
    <div class="field"><label class="field-label" data-i18n="email">البريد الإلكتروني</label><input class="input" type="email" id="login-email" placeholder="example@majaaz.iq"></div>
    <div class="field"><label class="field-label" data-i18n="password">كلمة المرور</label><input class="input" type="password" id="login-pass" placeholder="••••••••"></div>
    <button class="btn btn-primary btn-lg btn-full" id="btn-login" data-i18n="login_btn">دخول ←</button>

  </div>
</div>

<!-- ══ ADMIN ══ -->
<div id="view-admin" class="view">
  <div class="shell">
    <div class="sbar">
      <div class="sbar-top">
        <div class="sbar-brand">
          <div class="sbar-icon admin"><img src="data:image/png;base64,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" style="width:100%;height:100%;object-fit:contain;"></div>
          <div><div class="sbar-brand-name" data-i18n="brand">مجاز</div><span class="sbar-brand-sub admin">ADMIN</span></div>
        </div>
      </div>
      <div class="sbar-sec">
        <div class="sbar-sec-lbl" data-i18n="admin_section">الإدارة</div>
        <button class="nav-btn active" data-admin-tab="projects"><span class="nav-icon">🏛</span><span data-i18n="projects">المشاريع</span></button>
        <button class="nav-btn" data-admin-tab="jury"><span class="nav-icon">👥</span><span data-i18n="jury">اللجنة</span></button>
        <button class="nav-btn" data-admin-tab="evaluations"><span class="nav-icon">📋</span><span data-i18n="evaluations">التقييمات</span></button>
        <button class="nav-btn" data-admin-tab="criteria"><span class="nav-icon">✏️</span><span data-i18n="criteria_tab">معايير التقييم</span></button>
      </div>
      <div class="sbar-foot">
        <div class="user-row">
          <div class="user-av admin">A</div>
          <div><div class="user-info-name" data-i18n="admin_name">المدير العام</div><div class="user-info-role">Administrator</div></div>
        </div>
        <button class="btn btn-secondary btn-sm btn-full" id="btn-logout-admin" data-i18n="logout">خروج</button>
      </div>
    </div>
    <div class="main">
      <div id="admin-projects" class="dash-tab active">
        <div class="ph" style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;">
          <div><div class="ph-title">🏛 <span data-i18n="projects">المشاريع</span></div><div class="ph-sub" data-i18n="admin_proj_sub">رفع وإدارة المشاريع المشاركة</div></div>
          <button class="btn btn-primary btn-sm" id="btn-open-add-project" data-i18n="upload_project">+ رفع مشروع</button>
        </div>
        <div class="stat-strip" id="admin-proj-stats"></div>
        <div class="proj-grid" id="admin-projects-grid"></div>
        <div class="empty" id="admin-projects-empty" style="display:none;">
          <span class="empty-icon">🏛</span>
          <div class="empty-title" data-i18n="no_projects">لا توجد مشاريع</div>
          <p class="empty-sub" data-i18n="upload_first">ابدأ برفع أول مشروع</p>
        </div>
      </div>
      <div id="admin-jury" class="dash-tab">
        <div class="ph" style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;">
          <div><div class="ph-title">👥 <span data-i18n="jury_committee">لجنة التحكيم</span></div><div class="ph-sub" data-i18n="manage_jury">إدارة أعضاء اللجنة</div></div>
          <button class="btn btn-primary btn-sm" id="btn-open-add-jury" data-i18n="add_member">+ إضافة عضو</button>
        </div>
        <div class="stat-strip" id="admin-jury-stats"></div>
        <div class="tbl-wrap">
          <table class="tbl">
            <thead>
              <tr>
                <th data-i18n="th_member">العضو</th>
                <th data-i18n="th_email">البريد</th>
                <th data-i18n="th_password">كلمة المرور</th>
                <th data-i18n="th_published_evals">تقييمات منشورة</th>
                <th data-i18n="th_action">إجراء</th>
              </tr>
            </thead>
            <tbody id="jury-tbody"></tbody>
          </table>
        </div>
        <div class="empty" id="jury-empty" style="display:none;"><span class="empty-icon">👥</span><div class="empty-title" data-i18n="no_jury">لا يوجد أعضاء بعد</div></div>
      </div>
      <div id="admin-evaluations" class="dash-tab">
        <div class="ph"><div class="ph-title">📋 <span data-i18n="evaluations">التقييمات</span></div><div class="ph-sub" data-i18n="jury_evals_sub">تقييمات أعضاء اللجنة</div></div>
        <div id="admin-evals-list"></div>
      </div>
      <div id="admin-criteria" class="dash-tab">
        <div class="ph" style="display:flex;align-items:flex-start;justify-content:space-between;gap:12px;">
          <div><div class="ph-title">✏️ <span data-i18n="criteria_tab">معايير التقييم</span></div><div class="ph-sub" data-i18n="criteria_sub">تعديل نصوص معايير التقييم بالعربية والإنجليزية</div></div>
          <button class="btn btn-ghost btn-sm" id="btn-reset-criteria" data-i18n="reset_criteria">↺ إعادة للافتراضي</button>
        </div>
        <div id="criteria-editor" style="display:flex;flex-direction:column;gap:12px;margin-top:8px;"></div>
        <div style="margin-top:18px;display:flex;gap:10px;">
          <button class="btn btn-primary" id="btn-save-criteria" data-i18n="save_criteria">حفظ المعايير</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ══ JURY ══ -->
<div id="view-jury" class="view">
  <div class="shell">
    <div class="sbar">
      <div class="sbar-top">
        <div class="sbar-brand">
          <div class="sbar-icon jury"><img src="data:image/png;base64,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" style="width:100%;height:100%;object-fit:contain;"></div>
          <div><div class="sbar-brand-name" data-i18n="brand">مجاز</div><span class="sbar-brand-sub jury">JURY</span></div>
        </div>
      </div>
      <div class="sbar-sec">
        <div class="sbar-sec-lbl" data-i18n="judging_section">التحكيم</div>
        <button class="nav-btn active jury-role" data-jury-tab="projects"><span class="nav-icon">🏛</span><span data-i18n="projects">المشاريع</span></button>
        <button class="nav-btn jury-role" data-jury-tab="my-evals"><span class="nav-icon">📋</span><span data-i18n="my_evals">تقييماتي</span></button>
      </div>
      <div class="sbar-foot">
        <div class="user-row">
          <div class="user-av jury" id="jury-avatar">J</div>
          <div><div class="user-info-name" id="jury-name" data-i18n="jury_member">عضو اللجنة</div><div class="user-info-role">Jury Member</div></div>
        </div>
        <button class="btn btn-secondary btn-sm btn-full" id="btn-logout-jury" data-i18n="logout">خروج</button>
      </div>
    </div>
    <div class="main">
      <div id="jury-projects" class="dash-tab active">
        <div class="ph"><div class="ph-title">🏛 <span data-i18n="projects">المشاريع</span></div><div class="ph-sub" data-i18n="jury_proj_sub">انقر "تقييم" لعرض صور المشروع وتقديم تقييمك</div></div>
        <div class="proj-grid" id="jury-proj-grid"></div>
        <div class="empty" id="jury-proj-empty" style="display:none;"><span class="empty-icon">🏛</span><div class="empty-title" data-i18n="no_projects">لا توجد مشاريع بعد</div></div>
      </div>
      <div id="jury-my-evals" class="dash-tab">
        <div class="ph"><div class="ph-title">📋 <span data-i18n="my_evals">تقييماتي</span></div><div class="ph-sub" data-i18n="my_evals_sub">ملخص تقييماتك المقدمة</div></div>
        <div id="jury-evals-list"></div>
        <div class="empty" id="jury-evals-empty" style="display:none;"><span class="empty-icon">📋</span><div class="empty-title" data-i18n="no_evals_yet">لم تُقدّم أي تقييم بعد</div></div>
      </div>
    </div>
  </div>
</div>

<!-- ══ EVAL FULLSCREEN ══ -->
<div id="view-eval-fullscreen" class="view">
  <nav class="eval-nav">
    <div><div class="eval-nav-title" id="eval-fs-name" data-i18n="eval_project">تقييم المشروع</div><div class="eval-nav-sub" data-i18n="eval_nav_sub">عرض الصور ← تقييم المشروع</div></div>
    <button class="back-btn" id="eval-fs-back"><span class="back-btn-arrow">←</span> <span data-i18n="back">رجوع</span></button>
  </nav>
  <div class="car-outer" id="car-outer">
    <div class="car-viewport" id="car-viewport">
      <div class="car-slide-ph" id="car-ph" style="display:none;">🏛</div>
    </div>
    <button class="car-arrow car-ap" id="car-prev">&#8594;</button>
    <button class="car-arrow car-an" id="car-next">&#8592;</button>
    <div class="car-count" id="car-count">1 / 1</div>
  </div>
  <div class="zoom-bar">
    <button class="z-btn" id="zoom-in">＋</button>
    <span class="z-pct" id="zoom-pct">100%</span>
    <button class="z-btn" id="zoom-out">－</button>
    <button class="z-reset" id="zoom-reset" data-i18n="reset">↺ إعادة</button>
  </div>
  <div class="car-desc" id="car-desc"><span class="car-desc-icon">📝</span><span id="car-desc-txt" style="opacity:.4;font-style:italic;" data-i18n="no_desc">لا يوجد وصف</span></div>
  <div class="car-thumbs" id="car-thumbs"></div>
  <div class="scroll-hint" id="scroll-hint" onclick="document.getElementById('eval-form-anchor').scrollIntoView({behavior:'smooth',block:'nearest'})">
    <span data-i18n="scroll_to_eval">مرر للأسفل للتقييم</span><span class="scroll-hint-arrow">↓</span>
  </div>
  <div id="eval-form-anchor"></div>
  <div class="eval-form" id="eval-form-body"></div>
</div>

<!-- ══ MODAL: Project ══ -->
<div class="overlay" id="modal-add-project">
  <div class="modal">
    <div class="modal-hd">
      <div class="modal-hd-title">🏛 <span data-i18n="upload_new_project">رفع مشروع جديد</span></div>
      <button class="btn btn-ghost btn-sm btn-icon" data-close="modal-add-project">✕</button>
    </div>
    <div class="modal-bd">
      <div class="field">
        <label class="field-label" data-i18n="project_name">اسم المشروع <span class="req">*</span></label>
        <input class="input" id="proj-name-input" data-i18n-ph="proj_name_ph" placeholder="مثال: مشروع دار السلام">
      </div>
      <div class="field">
        <label class="field-label" data-i18n="cover_image">صورة الغلاف</label>
        <div class="upload-zone" id="cover-zone">
          <div class="uz-icon">🖼</div>
          <div class="uz-text" data-i18n="click_cover">انقر لرفع صورة الغلاف</div>
          <div class="uz-sub" data-i18n="img_hint">PNG أو JPG — حتى 1 MB</div>
        </div>
        <input type="file" id="cover-input" accept="image/*" style="display:none">
        <div id="cover-preview-wrap" style="display:none;border-radius:var(--rmd);overflow:hidden;border:1px solid var(--b1);margin-top:8px;">
          <img id="cover-preview" style="width:100%;max-height:130px;object-fit:cover;display:block;">
          <div style="padding:5px 9px;font-size:11px;color:var(--cyan);background:var(--s3);" id="cover-preview-name"></div>
        </div>
      </div>
      <div class="field">
        <label class="field-label"><span data-i18n="additional_images">الصور الإضافية</span> <span style="font-weight:400;color:var(--t3);" data-i18n="img_limit">(حتى ١٩ — وصف لكل صورة)</span></label>
        <div class="upload-zone" id="multi-zone">
          <div class="uz-icon">📁</div>
          <div class="uz-text" data-i18n="click_add_images">انقر لإضافة الصور</div>
          <div class="uz-sub" data-i18n="multi_select">يمكن تحديد عدة صور معاً</div>
        </div>
        <input type="file" id="multi-input" accept="image/*" multiple style="display:none">
        <div id="multi-count" style="font-size:11px;color:var(--t3);margin-top:4px;"></div>
        <div id="img-items-list" style="display:flex;flex-direction:column;gap:7px;margin-top:7px;"></div>
      </div>
    </div>
    <div class="modal-ft">
      <button class="btn btn-primary" id="btn-add-project" data-i18n="submit_project">رفع المشروع</button>
      <button class="btn btn-secondary" data-close="modal-add-project" data-i18n="cancel">إلغاء</button>
    </div>
  </div>
</div>

<!-- ══ MODAL: Jury ══ -->
<div class="overlay" id="modal-add-jury">
  <div class="modal">
    <div class="modal-hd">
      <div class="modal-hd-title">👤 <span data-i18n="add_jury_member">إضافة عضو لجنة</span></div>
      <button class="btn btn-ghost btn-sm btn-icon" data-close="modal-add-jury">✕</button>
    </div>
    <div class="modal-bd">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
        <div class="field"><label class="field-label" data-i18n="full_name">الاسم <span class="req">*</span></label><input class="input" id="jury-name-input" data-i18n-ph="name_ph" placeholder="د. أحمد محمد"></div>
        <div class="field"><label class="field-label" data-i18n="email">البريد <span class="req">*</span></label><input class="input" type="email" id="jury-email-input" placeholder="jury@majaaz.iq"></div>
      </div>
      <div class="field"><label class="field-label" data-i18n="password">كلمة المرور <span class="req">*</span></label><input class="input" type="password" id="jury-pass-input" data-i18n-ph="strong_pass" placeholder="كلمة مرور قوية"></div>
    </div>
    <div class="modal-ft">
      <button class="btn btn-primary" id="btn-add-jury" data-i18n="create_account">إنشاء الحساب</button>
      <button class="btn btn-secondary" data-close="modal-add-jury" data-i18n="cancel">إلغاء</button>
    </div>
  </div>
</div>

<!-- ══ LIGHTBOX ══ -->
<div class="lb" id="lb">
  <div class="lb-top">
    <div class="lb-top-title" id="lb-title"></div>
    <div class="lb-top-right"><span class="lb-count" id="lb-count"></span><button class="lb-x" id="lb-close">✕</button></div>
  </div>
  <div class="lb-body">
    <div class="lb-side"><div class="lb-side-lbl" data-i18n="img_desc">وصف الصورة</div><div class="lb-side-txt" id="lb-desc"></div></div>
    <div class="lb-img-wrap">
      <button class="lb-arr lb-arr-p" id="lb-prev">&#8594;</button>
      <img class="lb-img" id="lb-img" src="" alt="">
      <button class="lb-arr lb-arr-n" id="lb-next">&#8592;</button>
    </div>
  </div>
  <div class="lb-thumbs" id="lb-thumbs"></div>
</div>

<div class="toast-root" id="toast-root"></div>
<script>
(function(){

/* ══ PRODUCTION CONFIG ══ */
var API_BASE = 'api/';
var DB = { projects:[], evaluations:[], users:[], currentUser:null };

/* ── CSRF token store ──
   Stored in memory (set after first bootstrap.php call).
   Never empty after loadData() completes. */
var _csrfToken = '';
function getCsrfToken(){ return _csrfToken; }
function setCsrfToken(t){ if(t) _csrfToken = t; }

/* ── api() — POST with CSRF header ──
   If the server returns a 403 with "CSRF" in the error,
   we reload the token once and retry automatically. */
function api(endpoint, data){
  return fetch(API_BASE + endpoint, {
    method: 'POST',
    credentials: 'same-origin',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-Token': getCsrfToken()
    },
    body: JSON.stringify(data || {})
  })
  .then(function(r){ return r.json(); })
  .then(function(d){
    // Token expired mid-session — refresh and retry once
    if(!d.ok && d.error && d.error.indexOf('CSRF') !== -1){
      return fetch(API_BASE + 'bootstrap.php', {credentials:'same-origin'})
        .then(function(r){ return r.json(); })
        .then(function(b){
          if(b.csrfToken) setCsrfToken(b.csrfToken);
          return fetch(API_BASE + endpoint, {
            method: 'POST',
            credentials: 'same-origin',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-Token': getCsrfToken()
            },
            body: JSON.stringify(data || {})
          }).then(function(r){ return r.json(); });
        });
    }
    return d;
  });
}

function apiGet(endpoint){
  return fetch(API_BASE + endpoint, {credentials:'same-origin'})
    .then(function(r){ return r.json(); });
}

function hideLoader(){
  var loader = document.getElementById('app-loading');
  if(loader) loader.style.display = 'none';
}

function showLoaderError(msg){
  var loader = document.getElementById('app-loading');
  if(!loader) return;
  loader.innerHTML =
    '<div style="text-align:center;padding:32px;max-width:420px;">'
    +'<div style="font-size:32px;margin-bottom:16px;">⚠️</div>'
    +'<div style="font-family:\'IBM Plex Mono\',monospace;font-size:13px;color:#ef4444;margin-bottom:12px;word-break:break-all;">'+msg+'</div>'
    +'<div style="font-size:12px;color:var(--t3);margin-bottom:20px;">Check: DB running? Folder name correct? setup.php run?</div>'
    +'<button onclick="location.reload()" style="padding:8px 20px;background:var(--cyan);color:#000;border:none;border-radius:6px;cursor:pointer;font-size:13px;font-weight:600;">↺ Retry</button>'
    +'</div>';
}

async function loadData(){
  try{
    var resp = await fetch(API_BASE + 'bootstrap.php', {credentials:'same-origin'});

    // Non-200 HTTP response — show the raw error
    if(!resp.ok){
      showLoaderError('HTTP ' + resp.status + ' — ' + API_BASE + 'bootstrap.php');
      return;
    }

    var text = await resp.text();
    var d;
    try{
      d = JSON.parse(text);
    } catch(parseErr){
      // PHP error output — show first 300 chars so you can debug
      showLoaderError('PHP error in bootstrap.php:<br><br>' + text.substring(0,300).replace(/</g,'&lt;'));
      return;
    }

    if(!d.ok){
      showLoaderError('bootstrap.php returned error: ' + (d.error || 'unknown'));
      return;
    }

    DB.projects    = d.projects    || [];
    DB.evaluations = d.evaluations || [];
    DB.users       = d.users       || [];
    DB.currentUser = d.me          || null;
    if(d.csrfToken) setCsrfToken(d.csrfToken);

    hideLoader();

    // Auto-redirect if session active (e.g. browser refresh)
    if(DB.currentUser){
      if(DB.currentUser.role==='admin'){
        showView('admin'); renderAdminProjects();
      } else {
        g('jury-name').textContent = DB.currentUser.name;
        g('jury-avatar').textContent = (DB.currentUser.name||'J')[0];
        showView('jury'); renderJuryProjects();
      }
    } else {
      renderPublic();
    }

  } catch(e){
    // Network failure — Apache not running, wrong URL, etc.
    showLoaderError('Network error — is XAMPP Apache running?<br><br>' + e.message);
  }
}

/* ══ i18n DICTIONARY ══ */
var STRINGS = {
  ar: {
    brand: 'مجاز',
    nav_login: '🔐 دخول المحكّمين',
    hero_pill: 'مسابقة معمارية · العراق ٢٠٢٦',
    hero_title: 'بوابة تقييم مسابقة<br>مجاز المعمارية',
    hero_sub: 'استعرض المشاريع المشاركة واطّلع على تقييمات لجنة التحكيم',
    kpi_projects: 'مشروع', kpi_evaluated: 'مُقيَّم', kpi_published: 'تقييم منشور',
    all_projects: 'جميع المشاريع',
    no_projects: 'لا توجد مشاريع بعد', no_projects_sub: 'ستظهر المشاريع بعد رفعها من قِبل الإدارة',
    back_projects: 'العودة للمشاريع', back: 'رجوع',
    auth_title: 'مجاز ٢٠٢٦',
    tab_admin: 'إدارة النظام', tab_jury: 'عضو اللجنة',
    auth_error: 'البريد الإلكتروني أو كلمة المرور غير صحيحة',
    email: 'البريد الإلكتروني', password: 'كلمة المرور',
    login_btn: 'دخول ←',
    
    admin_section: 'الإدارة', judging_section: 'التحكيم',
    projects: 'المشاريع', jury: 'اللجنة', evaluations: 'التقييمات',
    admin_name: 'المدير العام',
    logout: 'خروج',
    admin_proj_sub: 'رفع وإدارة المشاريع المشاركة',
    upload_project: '+ رفع مشروع', upload_first: 'ابدأ برفع أول مشروع',
    jury_committee: 'لجنة التحكيم', manage_jury: 'إدارة أعضاء اللجنة',
    add_member: '+ إضافة عضو',
    th_member: 'العضو', th_email: 'البريد', th_password: 'كلمة المرور',
    th_published_evals: 'تقييمات منشورة', th_action: 'إجراء',
    no_jury: 'لا يوجد أعضاء بعد',
    jury_evals_sub: 'تقييمات أعضاء اللجنة',
    jury_member: 'عضو اللجنة', my_evals: 'تقييماتي',
    jury_proj_sub: 'انقر "تقييم" لعرض صور المشروع وتقديم تقييمك',
    my_evals_sub: 'ملخص تقييماتك المقدمة',
    no_evals_yet: 'لم تُقدّم أي تقييم بعد',
    eval_project: 'تقييم المشروع', eval_nav_sub: 'عرض الصور ← تقييم المشروع',
    reset: '↺ إعادة', no_desc: 'لا يوجد وصف',
    scroll_to_eval: 'مرر للأسفل للتقييم',
    upload_new_project: 'رفع مشروع جديد',
    project_name: 'اسم المشروع', proj_name_ph: 'مثال: مشروع دار السلام',
    cover_image: 'صورة الغلاف', click_cover: 'انقر لرفع صورة الغلاف',
    img_hint: 'PNG أو JPG — حتى 1 MB',
    additional_images: 'الصور الإضافية', img_limit: '(حتى ١٩ — وصف لكل صورة)',
    click_add_images: 'انقر لإضافة الصور', multi_select: 'يمكن تحديد عدة صور معاً',
    submit_project: 'رفع المشروع', cancel: 'إلغاء',
    add_jury_member: 'إضافة عضو لجنة',
    full_name: 'الاسم', name_ph: 'د. أحمد محمد',
    strong_pass: 'كلمة مرور قوية', create_account: 'إنشاء الحساب',
    img_desc: 'وصف الصورة',
    // dynamic strings
    view_project: 'عرض المشروع', waiting_eval: 'بانتظار التقييم',
    published_eval: 'تقييم منشور', draft: '💾 مسودة',
    published: '✓ منشور', pending: 'بانتظار',
    eval_btn: '📋 تقييم المشروع', edit_btn: '✏️ تعديل', view_eval: '✓ عرض التقييم',
    del_project: '🗑 حذف', delete: 'حذف',
    save_draft: '💾 حفظ مسودة', publish_eval: '✓ نشر التقييم',
    after_publish: 'بعد النشر لا يمكن التعديل',
    comment_label: 'التعليق العام', comment_req: '⚠️ التعليق إلزامي عند النشر فقط — يمكن الحفظ مسودة بدونه',
    comment_ph: 'اكتب ملاحظاتك التفصيلية هنا...',
    eval_result: '📋 نتيجة التقييم', published_final: 'تم النشر — هذا التقييم نهائي',
    eval_published_banner: '✓ تم نشر هذا التقييم للعموم',
    total_score: 'الدرجة الإجمالية',
    eval_criteria_title: '📋 تقييم المشروع', eval_criteria_sub: 'قيّم كل معيار ثم أضف تعليقك الإلزامي',
    no_img_desc: 'لا يوجد وصف لهذه الصورة',
    no_extra_imgs: 'لم تُرفع صور إضافية',
    gallery: '🗂 معرض الصور', jury_evaluations: '📋 تقييمات لجنة التحكيم',
    no_evals_published: '⏳ لم تُنشر أي تقييمات بعد',
    juror_default: 'محكّم',
    stat_uploaded: 'مشروع مرفوع', stat_published: 'تقييم منشور', stat_pending: 'بانتظار التقييم',
    stat_jury_members: 'عضو لجنة', stat_published_evals: 'تقييم منشور', stat_drafts: 'مسودة',
    add_jury_first: 'أضف أعضاء اللجنة أولاً', no_eval_yet: 'لم يُقيِّم أي مشروع بعد',
    tbl_project: 'المشروع', tbl_score: 'الدرجة', tbl_of100: 'من 100', tbl_status: 'الحالة', tbl_action: 'إجراء',
    cancel_eval: '🗑 إلغاء',
    saved_draft_note: '💾 يوجد تقييم محفوظ — يمكنك التعديل أو النشر',
    save_pw: 'حفظ', cancel_pw: 'إلغاء',
    change_pw_ph: 'New password',
    // Likert scale
    strongly_disagree: 'أرفض بشدة',
    disagree: 'أرفض',
    neutral: 'محايد',
    agree: 'أوافق',
    strongly_agree: 'أوافق بشدة',
    // Criteria (AR)
    c1: 'يهدف المشروع إلى حل مشكلة محددة وواقعية',
    c2: 'يقترح المشروع خطة حل واضحة وناجحة',
    c3: 'يُظهر الطالب منطقاً تصميمياً قوياً في قراراته',
    c4: 'لا يعاني المشروع من إشكاليات وظيفية جوهرية',
    c5: 'يبدو المشروع متناغماً مع موقعه ومتكيفاً مع بيئته',
    c6: 'يستجيب المشروع للمناخ والمواد المحلية',
    c7: 'الرسومات مفصّلة وواضحة وتشرح المشروع بشكل جيد',
    c8: 'يعكس المشروع جدية الطالب واجتهاده الواضح',
    c9: 'المشروع يُحقق أثراً اجتماعياً إيجابياً على المجتمع والبيئة المحيطة',
    c10: 'جودة التواصل البصري وقدرة الطالب على إيصال فكرته بوضوح',
    // Toasts
    t_published: 'تم النشر بنجاح 🎉', t_saved: 'تم الحفظ كمسودة 💾',
    t_project_added: 'تم رفع المشروع ✓', t_project_deleted: 'تم حذف المشروع',
    t_member_added: 'تم إنشاء الحساب ✓', t_member_deleted: 'تم حذف العضو',
    t_pw_changed: 'تم تغيير كلمة المرور ✓', t_eval_cancelled: 'تم إلغاء التقييم — يمكن للعضو إعادته ✓',
    // Validation
    v_all_criteria: 'يرجى الإجابة على جميع المعايير الثمانية',
    v_comment_req: 'التعليق إلزامي — لا يمكن المتابعة بدونه',
    v_project_name: 'يرجى إدخال اسم المشروع',
    v_name: 'يرجى إدخال الاسم', v_email: 'يرجى إدخال بريد صحيح',
    v_pass_short: 'كلمة المرور يجب أن تكون 6 أحرف على الأقل',
    v_email_exists: 'هذا البريد مسجّل مسبقاً',
    v_pw_short: 'كلمة المرور قصيرة جداً',
    // Confirm
    confirm_del_project: 'هل تريد حذف هذا المشروع؟',
    confirm_del_member: 'هل تريد حذف هذا العضو؟',
    // Welcome
    welcome_admin: 'لوحة الإدارة', welcome_jury: 'لوحة التحكيم',
    hi_prefix: 'أهلاً، ',
    // Cover limit
    cover_too_big: 'صورة الغلاف أكبر من 1 MB',
    img_max: 'وصلت للحد الأقصى 19 صورة',
    imgs_too_big: ' صورة تتجاوز 1 MB',
    img_count_suffix: ' صورة',
    img_max_label: ' (الحد الأقصى)',
    img_optional_desc: 'وصف اختياري...',
    confirm_cancel_eval_pre: 'هل تريد إلغاء تقييم ',
    confirm_cancel_eval_mid: ' لمشروع ',
    confirm_cancel_eval_suf: '؟\nسيتمكن العضو من إعادة التقييم من جديد.',
    juror_default_name: 'المحكّم', project_default: 'المشروع',
    criteria_tab: 'معايير التقييم', criteria_sub: 'تعديل نصوص معايير التقييم بالعربية والإنجليزية',
    reset_criteria: '↺ إعادة للافتراضي', save_criteria: 'حفظ المعايير',
    criteria_ar_label: 'النص العربي', criteria_en_label: 'English Text',
    t_criteria_saved: 'تم حفظ المعايير ✓', t_criteria_reset: 'تمت إعادة المعايير للافتراضي',
    criteria_q: 'المعيار',
    save_changes: 'حفظ التعديلات', current_cover: 'الغلاف الحالي',
    image: 'صورة', t_project_updated: 'تم تحديث المشروع ✓',
  },
  en: {
    brand: 'Majaaz',
    nav_login: '🔐 Jury Login',
    hero_pill: 'Architectural Competition · Iraq 2026',
    hero_title: 'Majaaz Architectural<br>Competition Portal',
    hero_sub: 'Browse submitted projects and view jury evaluation results',
    kpi_projects: 'Projects', kpi_evaluated: 'Evaluated', kpi_published: 'Published Reviews',
    all_projects: 'All Projects',
    no_projects: 'No projects yet', no_projects_sub: 'Projects will appear once uploaded by admin',
    back_projects: 'Back to Projects', back: 'Back',
    auth_title: 'Majaaz 2026',
    tab_admin: 'Admin Panel', tab_jury: 'Jury Member',
    auth_error: 'Incorrect email or password',
    email: 'Email address', password: 'Password',
    login_btn: 'Sign In →',
    
    admin_section: 'ADMIN', judging_section: 'JUDGING',
    projects: 'Projects', jury: 'Jury', evaluations: 'Evaluations',
    admin_name: 'General Manager',
    logout: 'Sign Out',
    admin_proj_sub: 'Upload and manage competition projects',
    upload_project: '+ Upload Project', upload_first: 'Start by uploading the first project',
    jury_committee: 'Jury Committee', manage_jury: 'Manage jury members',
    add_member: '+ Add Member',
    th_member: 'Member', th_email: 'Email', th_password: 'Password',
    th_published_evals: 'Published Evals', th_action: 'Action',
    no_jury: 'No jury members yet',
    jury_evals_sub: 'Jury member evaluations',
    jury_member: 'Jury Member', my_evals: 'My Evaluations',
    jury_proj_sub: 'Click "Evaluate" to view project images and submit your score',
    my_evals_sub: 'Summary of your submitted evaluations',
    no_evals_yet: 'No evaluations submitted yet',
    eval_project: 'Project Evaluation', eval_nav_sub: 'View Images → Evaluate Project',
    reset: '↺ Reset', no_desc: 'No description',
    scroll_to_eval: 'Scroll down to evaluate',
    upload_new_project: 'Upload New Project',
    project_name: 'Project Name', proj_name_ph: 'e.g. Dar Al-Salam Project',
    cover_image: 'Cover Image', click_cover: 'Click to upload cover image',
    img_hint: 'PNG or JPG — up to 1 MB',
    additional_images: 'Additional Images', img_limit: '(up to 19 — add description per image)',
    click_add_images: 'Click to add images', multi_select: 'You can select multiple images',
    submit_project: 'Submit Project', cancel: 'Cancel',
    add_jury_member: 'Add Jury Member',
    full_name: 'Full Name', name_ph: 'Dr. Ahmed Mohamed',
    strong_pass: 'Strong password', create_account: 'Create Account',
    img_desc: 'Image Description',
    // dynamic strings
    view_project: 'View Project', waiting_eval: 'Awaiting Evaluation',
    published_eval: 'published review', draft: '💾 Draft',
    published: '✓ Published', pending: 'Pending',
    eval_btn: '📋 Evaluate Project', edit_btn: '✏️ Edit', view_eval: '✓ View Evaluation',
    del_project: '🗑 Delete', delete: 'Delete',
    save_draft: '💾 Save Draft', publish_eval: '✓ Publish Evaluation',
    after_publish: 'Once published, evaluation cannot be edited',
    comment_label: 'General Comment', comment_req: '⚠️ Comment required for publishing — optional for draft',
    comment_ph: 'Write your detailed remarks here...',
    eval_result: '📋 Evaluation Result', published_final: 'Published — This evaluation is final',
    eval_published_banner: '✓ This evaluation has been published',
    total_score: 'Total Score',
    eval_criteria_title: '📋 Project Evaluation', eval_criteria_sub: 'Rate each criterion then add your required comment',
    no_img_desc: 'No description for this image',
    no_extra_imgs: 'No additional images uploaded',
    gallery: '🗂 Image Gallery', jury_evaluations: '📋 Jury Evaluations',
    no_evals_published: '⏳ No evaluations published yet',
    juror_default: 'Juror',
    stat_uploaded: 'Projects Uploaded', stat_published: 'Published Evals', stat_pending: 'Awaiting Evaluation',
    stat_jury_members: 'Jury Members', stat_published_evals: 'Published Evals', stat_drafts: 'Drafts',
    add_jury_first: 'Add jury members first', no_eval_yet: 'No projects evaluated yet',
    tbl_project: 'Project', tbl_score: 'Score', tbl_of100: 'Out of 100', tbl_status: 'Status', tbl_action: 'Action',
    cancel_eval: '🗑 Cancel',
    saved_draft_note: '💾 Saved draft — you can edit or publish',
    save_pw: 'Save', cancel_pw: 'Cancel',
    change_pw_ph: 'New password',
    strongly_disagree: 'Strongly Disagree',
    disagree: 'Disagree', neutral: 'Neutral', agree: 'Agree', strongly_agree: 'Strongly Agree',
    c1: 'Project addresses a specific real-world problem',
    c2: 'Project proposes a clear and viable solution',
    c3: 'Student shows strong design logic in decisions',
    c4: 'Project has no major functional issues',
    c5: 'Project harmonizes with site and environment',
    c6: 'Project responds to local climate and materials',
    c7: 'Drawings are detailed, clear and well-explained',
    c8: 'Project reflects student dedication and effort',
    c9: 'Project achieves a positive social impact on the surrounding community and environment',
    c10: 'Quality of visual communication and ability to convey the design idea clearly',
    t_published: 'Published successfully 🎉', t_saved: 'Saved as draft 💾',
    t_project_added: 'Project uploaded ✓', t_project_deleted: 'Project deleted',
    t_member_added: 'Account created ✓', t_member_deleted: 'Member removed',
    t_pw_changed: 'Password changed ✓', t_eval_cancelled: 'Evaluation cancelled — member can re-evaluate ✓',
    v_all_criteria: 'Please rate all eight criteria',
    v_comment_req: 'Comment is required — cannot continue without it',
    v_project_name: 'Please enter a project name',
    v_name: 'Please enter a name', v_email: 'Please enter a valid email',
    v_pass_short: 'Password must be at least 6 characters',
    v_email_exists: 'This email is already registered',
    v_pw_short: 'Password is too short',
    confirm_del_project: 'Are you sure you want to delete this project?',
    confirm_del_member: 'Are you sure you want to remove this member?',
    welcome_admin: 'Admin Panel', welcome_jury: 'Jury Dashboard',
    hi_prefix: 'Welcome, ',
    cover_too_big: 'Cover image exceeds 1 MB',
    img_max: 'Maximum of 19 images reached',
    imgs_too_big: ' image(s) exceed 1 MB',
    img_count_suffix: ' image(s)',
    img_max_label: ' (max)',
    img_optional_desc: 'Optional description...',
    confirm_cancel_eval_pre: 'Cancel evaluation by ',
    confirm_cancel_eval_mid: ' for project ',
    confirm_cancel_eval_suf: '?\nThe member will be able to re-evaluate.',
    juror_default_name: 'Juror', project_default: 'Project',
    criteria_tab: 'Eval Criteria', criteria_sub: 'Edit evaluation criteria text in Arabic and English',
    reset_criteria: '↺ Reset to Default', save_criteria: 'Save Criteria',
    criteria_ar_label: 'Arabic Text', criteria_en_label: 'English Text',
    t_criteria_saved: 'Criteria saved ✓', t_criteria_reset: 'Criteria reset to default',
    criteria_q: 'Criterion',
    save_changes: 'Save Changes', current_cover: 'Current Cover',
    image: 'Image', t_project_updated: 'Project updated ✓',
  }
};
var LANG = 'ar';
function t(key){ return (STRINGS[LANG]||STRINGS.ar)[key] || key; }
function applyLang(){
  var html=document.getElementById('root-html');
  html.lang=LANG; html.dir=LANG==='ar'?'rtl':'ltr';
  document.querySelectorAll('[data-i18n]').forEach(function(el){
    var key=el.getAttribute('data-i18n');var val=t(key);
    if(el.innerHTML.indexOf('<')!==-1&&val.indexOf('<br>')!==-1){el.innerHTML=val;}else{el.textContent=val;}
  });
  document.querySelectorAll('[data-i18n-ph]').forEach(function(el){el.placeholder=t(el.getAttribute('data-i18n-ph'));});
  document.getElementById('lang-label').textContent=LANG==='ar'?'EN':'عربي';
  if(document.getElementById('view-public').classList.contains('active'))renderPublic();
}
function toggleLang(){LANG=LANG==='ar'?'en':'ar';applyLang();}

/* ══ DEFAULT CRITERIA ══ */
var DEFAULT_CRITERIA={
  ar:['يهدف المشروع إلى حل مشكلة محددة وواقعية','يقترح المشروع خطة حل واضحة وناجحة','يُظهر الطالب منطقاً تصميمياً قوياً في قراراته','لا يعاني المشروع من إشكاليات وظيفية جوهرية','يبدو المشروع متناغماً مع موقعه ومتكيفاً مع بيئته','يستجيب المشروع للمناخ والمواد المحلية','الرسومات مفصّلة وواضحة وتشرح المشروع بشكل جيد','يعكس المشروع جدية الطالب واجتهاده الواضح','المشروع يُحقق أثراً اجتماعياً إيجابياً على المجتمع والبيئة المحيطة','جودة التواصل البصري وقدرة الطالب على إيصال فكرته بوضوح'],
  en:['Project addresses a specific real-world problem','Project proposes a clear and viable solution','Student shows strong design logic in decisions','Project has no major functional issues','Project harmonizes with site and environment','Project responds to local climate and materials','Drawings are detailed, clear and well-explained','Project reflects student dedication and effort','Project achieves a positive social impact on the surrounding community and environment','Quality of visual communication and ability to convey the design idea clearly']
};
var customCriteria=null;
function getCriteria(){
  if(customCriteria)return LANG==='ar'?customCriteria.ar:customCriteria.en;
  return [t('c1'),t('c2'),t('c3'),t('c4'),t('c5'),t('c6'),t('c7'),t('c8'),t('c9'),t('c10')];
}
function getLikert(){
  return [{l:t('strongly_disagree'),v:2},{l:t('disagree'),v:4},{l:t('neutral'),v:6},{l:t('agree'),v:8},{l:t('strongly_agree'),v:10}];
}

/* ══ GLOBALS ══ */
var MAX=100;
var stageCover=null,stageImgs=[],evalScores=[],carProjId=null,carZoomScale=1,carPanX=0,carPanY=0;
var carDrag={active:false,startX:0,startY:0,startPanX:0,startPanY:0};
var carIdx=0,carItems=[];
var lbItems=[],lbIdx=0;
var curAdminTab='projects';
var editingProjectId=null;

/* ══ HELPERS ══ */
function g(id){return document.getElementById(id);}
function genId(){return 'i'+Math.random().toString(36).substr(2,8);}
function num(v){var n=parseFloat(v);return isNaN(n)?0:n;}  // safe number conversion
function norm(r){return Math.round(r/MAX*100);}
function readFile(f,cb){var r=new FileReader();r.onload=function(e){cb(e.target.result);};r.readAsDataURL(f);}
function toast(msg,type){
  var w=g('toast-root');var el=document.createElement('div');
  el.className='toast '+(type==='err'?'err':'ok');
  el.innerHTML='<span class="toast-dot"></span>'+msg;
  w.appendChild(el);
  setTimeout(function(){el.style.opacity='0';el.style.transition='opacity .3s';setTimeout(function(){el.remove();},300);},3000);
}
function showView(v){
  document.querySelectorAll('.view').forEach(function(el){el.classList.remove('active');});
  g('view-'+v).classList.add('active');
  if(v==='public')renderPublic();
}
function openModal(id){g(id).classList.add('open');}
function closeModal(id){g(id).classList.remove('open');}
function fieldErr(el,msg){el.classList.add('err');toast(msg,'err');el.focus();}
function fieldOk(el){el.classList.remove('err');}
function closeEditMode(){
  editingProjectId=null;
  if(g('btn-add-project'))g('btn-add-project').textContent=t('submit_project');
  var ew=g('edit-cover-wrap');if(ew)ew.style.display='none';
}

/* ══ LIGHTBOX ══ */
function openLb(items,idx,title){
  lbItems=items;lbIdx=idx||0;
  g('lb-title').textContent=title||'';
  buildLbThumbs();updLb();g('lb').classList.add('open');
}
function buildLbThumbs(){
  var s=g('lb-thumbs');s.innerHTML='';
  lbItems.forEach(function(it,i){
    var img=document.createElement('img');img.className='lb-th'+(i===lbIdx?' active':'');img.src=it.dataUrl;
    img.addEventListener('click',function(){lbIdx=i;updLb();});s.appendChild(img);
  });
}
function updLb(){
  var it=lbItems[lbIdx];
  g('lb-img').src=it.dataUrl;
  g('lb-count').textContent=(lbIdx+1)+' / '+lbItems.length;
  g('lb-desc').innerHTML=it.desc?it.desc:'<span style="opacity:.35;font-style:italic;">'+t('no_desc')+'</span>';
  document.querySelectorAll('.lb-th').forEach(function(x,i){x.classList.toggle('active',i===lbIdx);});
  var at=document.querySelectorAll('.lb-th')[lbIdx];if(at)at.scrollIntoView({behavior:'smooth',block:'nearest',inline:'center'});
}
g('lb-close').onclick=function(){g('lb').classList.remove('open');};
g('lb-prev').onclick=function(){lbIdx=(lbIdx-1+lbItems.length)%lbItems.length;updLb();};
g('lb-next').onclick=function(){lbIdx=(lbIdx+1)%lbItems.length;updLb();};
g('lb').addEventListener('click',function(e){if(e.target===this)this.classList.remove('open');});
document.addEventListener('keydown',function(e){
  if(!g('lb').classList.contains('open'))return;
  if(e.key==='ArrowLeft')g('lb-next').click();
  if(e.key==='ArrowRight')g('lb-prev').click();
  if(e.key==='Escape')g('lb').classList.remove('open');
});

/* ══ CAROUSEL ══ */
function buildCar(items){
  carItems=items;carIdx=0;carZoomScale=1;carPanX=0;carPanY=0;
  var vp=g('car-viewport');
  vp.querySelectorAll('.car-img').forEach(function(el){el.remove();});
  g('car-ph').style.display='none';
  if(!items.length)return;
  items.forEach(function(it,i){
    if(!it.dataUrl)return;
    var img=document.createElement('img');
    img.className='car-img'+(i===0?'':' hidden');
    img.src=it.dataUrl;img.draggable=false;
    vp.appendChild(img);
  });
  if(!items[0].dataUrl)g('car-ph').style.display='block';
  buildCarThumbs();updCarUI();setupZoomPan();
}
function buildCarThumbs(){
  var thumbs=g('car-thumbs');thumbs.innerHTML='';
  carItems.forEach(function(it,i){
    if(!it.dataUrl)return;
    var th=document.createElement('img');th.className='car-th'+(i===0?' active':'');th.src=it.dataUrl;
    th.addEventListener('click',function(){goSlide(i);});thumbs.appendChild(th);
  });
}
function goSlide(i){
  var imgs=g('car-viewport').querySelectorAll('.car-img');
  if(imgs[carIdx])imgs[carIdx].classList.add('hidden');
  carIdx=Math.max(0,Math.min(i,carItems.length-1));
  carZoomScale=1;carPanX=0;carPanY=0;
  if(imgs[carIdx]){imgs[carIdx].classList.remove('hidden');applyTransform(imgs[carIdx]);}
  g('car-outer').classList.remove('zoomed');updCarUI();
}
function prevSlide(){goSlide(carIdx-1);}
function nextSlide(){goSlide(carIdx+1);}
function getActiveImg(){return g('car-viewport').querySelectorAll('.car-img')[carIdx]||null;}
function applyTransform(img){
  if(!img)return;
  img.style.transform='translate('+carPanX+'px,'+carPanY+'px) scale('+carZoomScale+')';
  img.style.transformOrigin='center center';
}
function applyZoom(){
  var img=getActiveImg();applyTransform(img);
  g('zoom-pct').textContent=Math.round(carZoomScale*100)+'%';
  g('car-outer').classList.toggle('zoomed',carZoomScale>1);
}
function resetZoom(){carZoomScale=1;carPanX=0;carPanY=0;applyZoom();}
function setupZoomPan(){
  var outer=g('car-outer');
  var newOuter=outer.cloneNode(true);
  outer.parentNode.replaceChild(newOuter,outer);
  newOuter.querySelector('#car-prev').onclick=prevSlide;
  newOuter.querySelector('#car-next').onclick=nextSlide;
  newOuter.addEventListener('wheel',function(e){
    e.preventDefault();
    var delta=e.deltaY>0?-0.15:0.15;
    carZoomScale=Math.min(4,Math.max(1,carZoomScale+delta));
    if(carZoomScale===1){carPanX=0;carPanY=0;}applyZoom();
  },{passive:false});
  newOuter.addEventListener('mousedown',function(e){
    if(carZoomScale<=1)return;
    carDrag={active:true,startX:e.clientX,startY:e.clientY,startPanX:carPanX,startPanY:carPanY};
    e.preventDefault();
  });
  window.addEventListener('mousemove',function(e){
    if(!carDrag.active)return;
    carPanX=carDrag.startPanX+(e.clientX-carDrag.startX);
    carPanY=carDrag.startPanY+(e.clientY-carDrag.startY);applyZoom();
  });
  window.addEventListener('mouseup',function(){carDrag.active=false;});
  var tsx=0,tsy=0,tpinchStart=0;
  newOuter.addEventListener('touchstart',function(e){
    if(e.touches.length===2){tpinchStart=Math.hypot(e.touches[0].clientX-e.touches[1].clientX,e.touches[0].clientY-e.touches[1].clientY);}
    else{tsx=e.touches[0].clientX;tsy=e.touches[0].clientY;}
  },{passive:true});
  newOuter.addEventListener('touchmove',function(e){
    if(e.touches.length===2){
      e.preventDefault();
      var dist=Math.hypot(e.touches[0].clientX-e.touches[1].clientX,e.touches[0].clientY-e.touches[1].clientY);
      carZoomScale=Math.min(4,Math.max(1,carZoomScale*(dist/tpinchStart>1?1.03:0.97)));
      if(carZoomScale===1){carPanX=0;carPanY=0;}applyZoom();tpinchStart=dist;
    }
  },{passive:false});
  newOuter.addEventListener('touchend',function(e){
    if(e.changedTouches.length===1&&carZoomScale<=1){
      var dx=e.changedTouches[0].clientX-tsx;var dy=e.changedTouches[0].clientY-tsy;
      if(Math.abs(dx)>Math.abs(dy)&&Math.abs(dx)>40){dx<0?nextSlide():prevSlide();}
    }
  },{passive:true});
}
g('zoom-in').onclick=function(){carZoomScale=Math.min(carZoomScale+0.25,4);if(carZoomScale>1)g('car-outer').classList.add('zoomed');applyZoom();};
g('zoom-out').onclick=function(){carZoomScale=Math.max(carZoomScale-0.25,1);if(carZoomScale===1){carPanX=0;carPanY=0;g('car-outer').classList.remove('zoomed');}applyZoom();};
g('zoom-reset').onclick=resetZoom;
document.addEventListener('keydown',function(e){
  if(!g('view-eval-fullscreen').classList.contains('active'))return;
  if(e.key==='ArrowLeft')nextSlide();if(e.key==='ArrowRight')prevSlide();
  if(e.key==='+'||e.key==='='){carZoomScale=Math.min(carZoomScale+0.25,4);applyZoom();}
  if(e.key==='-'){carZoomScale=Math.max(carZoomScale-0.25,1);if(carZoomScale===1){carPanX=0;carPanY=0;}applyZoom();}
  if(e.key==='Escape')resetZoom();
});
function updCarUI(){
  g('car-count').textContent=(carIdx+1)+' / '+carItems.length;
  g('zoom-pct').textContent=Math.round(carZoomScale*100)+'%';
  var it=carItems[carIdx];var dt=g('car-desc-txt');
  if(it&&it.desc&&it.desc.trim()){dt.textContent=it.desc;dt.style.opacity='1';dt.style.fontStyle='normal';}
  else{dt.textContent=t('no_img_desc');dt.style.opacity='.4';dt.style.fontStyle='italic';}
  document.querySelectorAll('.car-th').forEach(function(x,i){x.classList.toggle('active',i===carIdx);});
  var at=document.querySelectorAll('.car-th')[carIdx];if(at)at.scrollIntoView({behavior:'smooth',block:'nearest',inline:'center'});
  g('car-prev').disabled=(carIdx===0);g('car-next').disabled=(carIdx===carItems.length-1);
}
g('eval-fs-back').onclick=function(){showView('jury');renderJuryProjects();};

/* ══ EVAL FULLSCREEN ══ */
function openEvalFs(pid){
  var p=DB.projects.filter(function(x){return x.id===pid;})[0];if(!p)return;
  carProjId=pid;g('eval-fs-name').textContent=p.name;
  var items=[];
  if(p.cover)items.push({dataUrl:p.cover,desc:''});
  p.images.forEach(function(img){items.push({dataUrl:img.dataUrl,desc:img.desc||''});});
  if(!items.length)items.push({dataUrl:null,desc:''});
  buildCar(items);
  var ex=getMyEval(pid);
  evalScores=ex?ex.scores.slice():getCriteria().map(function(){return 0;});
  renderEvalForm(pid,ex);
  showView('eval-fullscreen');
}
function renderEvalForm(pid,ex){
  var body=g('eval-form-body');
  var CRITERIA=getCriteria();
  if(ex&&ex.published){
    var pct=num(ex.rawScore)/MAX*100;
    body.innerHTML='<div class="ef-title">'+t('eval_result')+'</div><div class="ef-sub">'+t('published_final')+'</div>'
      +'<div class="pub-banner">'+t('eval_published_banner')+'</div>'
      +'<div class="score-live"><div class="sl-big">'+((num(ex.rawScore)/10).toFixed(1))+' / 10</div><div class="sl-lbl">'+t('total_score')+'</div></div>'
      +'<div class="er-bar" style="margin-bottom:18px;"><div class="er-bar-fill" style="width:'+pct+'%"></div></div>'
      +CRITERIA.map(function(q,i){
        return '<div style="display:flex;justify-content:space-between;align-items:center;padding:8px 0;border-bottom:1px solid var(--b1);font-size:13px;">'
          +'<span style="color:var(--t2);flex:1;">'+(i+1)+'. '+q+'</span>'
          +'<span style="font-family:\'IBM Plex Mono\',monospace;color:var(--cyan);font-weight:600;margin-'+(LANG==='ar'?'right':'left')+':10px;">'+ex.scores[i]+'</span></div>';
      }).join('')
      +(ex.comment?'<div class="er-comment" style="margin-top:14px;">'+ex.comment+'</div>':'');
    return;
  }
  var ans=evalScores.filter(function(s){return s>0;}).length;
  var raw=evalScores.reduce(function(a,b){return a+b;},0);
  var LIKERT=getLikert();
  body.innerHTML=(ex?'<div style="background:var(--blb);border:1px solid rgba(59,130,246,.18);border-radius:var(--rmd);padding:9px 13px;font-size:12px;color:var(--bl);margin-bottom:14px;">'+t('saved_draft_note')+'</div>':'')
    +'<div class="ef-title">'+t('eval_criteria_title')+'</div><div class="ef-sub">'+t('eval_criteria_sub')+'</div>'
    +'<div class="prog-row"><div class="prog-bar"><div class="prog-fill" id="prog-fill" style="width:'+(ans/CRITERIA.length*100)+'%"></div></div><div class="prog-txt" id="prog-txt">'+ans+' / '+CRITERIA.length+'</div></div>'
    +'<div class="score-live"><div class="sl-big" id="sl-big">'+((raw/10).toFixed(1))+' / 10</div><div class="sl-lbl">'+t('total_score')+'</div></div>'
    +CRITERIA.map(function(q,i){
      return '<div class="lk-card'+(evalScores[i]>0?' done':'')+'" id="lkc'+i+'">'
        +'<div class="lk-q"><span class="lk-qn">'+(i+1)+'.</span>'+q+'</div>'
        +'<div class="lk-scale">'+LIKERT.map(function(lk){
          return '<button class="lk-opt'+(evalScores[i]===lk.v?' sel':'')+'" data-q="'+i+'" data-v="'+lk.v+'">'
            +'<span class="lk-v">'+lk.v+'</span>'+lk.l+'</button>';
        }).join('')+'</div></div>';
    }).join('')
    +'<div class="comment-section">'
    +'<label class="field-label" style="font-size:13px;color:var(--t1);">'+t('comment_label')+' <span class="req">*</span></label>'
    +'<div class="comment-req-note">'+t('comment_req')+'</div>'
    +'<textarea class="input" id="eval-comment" rows="4" placeholder="'+t('comment_ph')+'">'+(ex?ex.comment:'')+'</textarea>'
    +'</div>'
    +'<div class="eval-actions">'
    +'<button class="btn btn-save" id="btn-draft">'+t('save_draft')+'</button>'
    +'<button class="btn btn-primary" id="btn-publish">'+t('publish_eval')+'</button>'
    +'</div>'
    +'<div style="font-size:11px;color:var(--t3);text-align:center;margin-top:10px;">'+t('after_publish')+'</div>';
  body.querySelectorAll('.lk-opt').forEach(function(btn){
    btn.addEventListener('click',function(){setScore(parseInt(this.dataset.q),parseInt(this.dataset.v));});
  });
  g('btn-draft').onclick=function(){saveEval(false);};
  g('btn-publish').onclick=function(){saveEval(true);};
}
function setScore(q,v){
  evalScores[q]=v;
  document.querySelectorAll('[data-q="'+q+'"]').forEach(function(b){b.classList.toggle('sel',parseInt(b.dataset.v)===v);});
  var card=g('lkc'+q);if(card)card.classList.add('done');
  var raw=evalScores.reduce(function(a,b){return a+b;},0);
  var ans=evalScores.filter(function(s){return s>0;}).length;
  var CRITERIA=getCriteria();
  var sb=g('sl-big');if(sb)sb.textContent=(raw/10).toFixed(1)+' / 10';
  var pf=g('prog-fill');if(pf)pf.style.width=(ans/CRITERIA.length*100)+'%';
  var pt=g('prog-txt');if(pt)pt.textContent=ans+' / '+CRITERIA.length;
}

/* ══ SAVE EVAL — real API ══ */
function saveEval(publish){
  var ce=g('eval-comment');
  var comment=ce?ce.value.trim():'';

  if(publish){
    // PUBLISH — strict validation: all criteria + comment required
    if(evalScores.some(function(s){return s===0;})){
      toast(t('v_all_criteria'),'err');return;
    }
    if(!comment){
      if(ce){fieldErr(ce,t('v_comment_req'));ce.scrollIntoView({behavior:'smooth',block:'center'});}
      return;
    }
  } else {
    // DRAFT — relaxed: at least 1 criterion answered, comment optional
    var answered=evalScores.filter(function(s){return s>0;}).length;
    if(answered===0){
      toast(t('v_all_criteria'),'err');return;
    }
  }

  if(ce)fieldOk(ce);
  var raw=evalScores.reduce(function(a,b){return a+b;},0);
  var btn1=g('btn-draft'),btn2=g('btn-publish');
  if(btn1)btn1.disabled=true;if(btn2)btn2.disabled=true;

  api('jury_save_evaluation.php',{
    projectId: carProjId,
    scores: evalScores.slice(),
    comment: comment,
    published: publish
  })
  .then(function(d){
    if(!d.ok){
      toast(d.error||'Error','err');
      if(btn1)btn1.disabled=false;
      if(btn2)btn2.disabled=false;
      return;
    }
    // Update local DB with returned evaluations immediately
    if(d.evaluations) DB.evaluations = d.evaluations;
    toast(publish?t('t_published'):t('t_saved'));
    showView('jury');
    renderJuryProjects();
    if(btn1)btn1.disabled=false;
    if(btn2)btn2.disabled=false;
  }).catch(function(e){
    toast('Network error: '+e.message,'err');
    if(btn1)btn1.disabled=false;
    if(btn2)btn2.disabled=false;
  });
}

/* ══ PUBLIC RENDER ══ */
function renderPublic(){
  var grid=g('pub-grid'),empty=g('pub-empty');
  var pubEvals=DB.evaluations.filter(function(e){return e.published;});
  var evMap={};pubEvals.forEach(function(e){evMap[e.projectId]=(evMap[e.projectId]||0)+1;});
  g('pub-total').textContent=DB.projects.length;
  g('pub-evaluated').textContent=Object.keys(evMap).length;
  g('pub-evals-count').textContent=pubEvals.length;
  grid.innerHTML='';
  if(!DB.projects.length){empty.style.display='block';grid.style.display='none';return;}
  empty.style.display='none';grid.style.display='grid';
  DB.projects.forEach(function(p){
    var evCount=evMap[p.id]||0;
    var allImgs=p.images||[];
    var totalImgs=(p.cover?1:0)+allImgs.length;
    var card=document.createElement('div');card.className='pub-card';
    card.innerHTML='<div class="pub-card-img">'
      +(p.cover?'<img src="'+p.cover+'" loading="lazy">'
        :'<div class="pub-card-ph">🏛</div>')
      +'<div class="pub-card-grad"></div>'
      +(totalImgs>1?'<div class="img-chip">📷 '+totalImgs+'</div>':'')
      +'<button class="pub-card-cta">'+t('view_project')+'</button>'
      +'</div>'
      +'<div class="pub-card-body"><div class="pub-card-name">'+p.name+'</div>'
      +'<div class="pub-card-foot">'
      +(evCount?'<span class="badge bg">'+evCount+' '+t('published_eval')+'</span>':'<span class="badge ba">'+t('waiting_eval')+'</span>')
      +'</div></div>';
    card.addEventListener('click',function(){showProjectDetail(p.id);});
    grid.appendChild(card);
  });
}

/* ══ PROJECT DETAIL ══ */
function showProjectDetail(pid){
  var p=DB.projects.filter(function(x){return x.id===pid;})[0];if(!p)return;
  var pubEvals=DB.evaluations.filter(function(e){return e.projectId===pid&&e.published;});
  var lbList=[];
  if(p.cover)lbList.push({dataUrl:p.cover,desc:''});
  (p.images||[]).forEach(function(img){lbList.push({dataUrl:img.dataUrl,desc:img.desc||''});});
  var heroHtml='<div class="d-hero" id="dhc">'
    +(p.cover?'<img src="'+p.cover+'">'
      :'<div class="d-hero-ph">🏛</div>')
    +'<div class="d-hero-grad"></div>'
    +'<div class="d-hero-info"><h1>'+p.name+'</h1>'
    +(pubEvals.length?'<span class="badge bg">'+pubEvals.length+' '+t('published_eval')+'</span>':'<span class="badge ba">'+t('waiting_eval')+'</span>')
    +'</div></div>';
  var galHtml='<div style="margin-bottom:40px;"><div class="sec-heading" style="margin-bottom:16px;">'+t('gallery')+'</div>';
  if(p.images&&p.images.length){
    galHtml+='<div class="gal-grid">'
      +p.images.map(function(img,i){
        var idx=p.cover?i+1:i;
        return '<div class="gal-item" data-lb="'+idx+'">'
          +'<img src="'+img.dataUrl+'" loading="lazy">'
          +(img.desc?'<div class="gal-item-desc">'+img.desc+'</div>':'')
          +'</div>';
      }).join('')+'</div>';
  } else {
    galHtml+='<div style="padding:26px;text-align:center;color:var(--t3);font-size:13px;background:var(--s2);border-radius:var(--rlg);border:1px dashed var(--b2);">'+t('no_extra_imgs')+'</div>';
  }
  galHtml+='</div>';
  var evHtml='<div><div class="sec-heading" style="margin-bottom:16px;">'+t('jury_evaluations')+'</div>';
  if(!pubEvals.length){
    evHtml+='<div style="padding:36px;text-align:center;background:var(--s2);border-radius:var(--rxl);border:1px dashed var(--b2);color:var(--t3);">'+t('no_evals_published')+'</div>';
  } else {
    evHtml+=pubEvals.map(function(ev){
      var juror=DB.users.filter(function(u){return u.id===ev.juryId;})[0];
      var jurorName=ev.juryName||(juror?juror.name:t('juror_default'));
      var pct=num(ev.rawScore)/MAX*100;
      var avg=(num(ev.rawScore)/10).toFixed(1);
      return '<div class="er"><div class="er-hd">'
        +'<div><div class="er-name">👤 '+jurorName+'</div></div>'
        +'<div style="text-align:'+(LANG==='ar'?'left':'right')+'"><div class="er-score-big">'+avg+' / 10</div></div>'
        +'</div><div class="er-bar"><div class="er-bar-fill" style="width:'+pct+'%"></div></div>'
        +(ev.comment?'<div class="er-comment">'+ev.comment+'</div>':'')
        +'</div>';
    }).join('');
  }
  evHtml+='</div>';
  var evalBtnHtml='';
  if(DB.currentUser&&DB.currentUser.role==='jury'){
    var myEv=getMyEval(pid);
    var btnLbl=myEv&&myEv.published?t('view_eval'):myEv?t('edit_btn'):t('eval_btn');
    var btnCls=myEv&&myEv.published?'btn-secondary':'btn-primary';
    evalBtnHtml='<div class="eval-actions" style="padding:0 0 32px;"><button class="btn '+btnCls+' btn-lg" id="detail-eval-btn">'+btnLbl+'</button></div>';
  }
  g('detail-content').innerHTML=heroHtml+'<div class="d-body">'+evalBtnHtml+galHtml+evHtml+'</div>';
  if(DB.currentUser&&DB.currentUser.role==='jury'){
    var eb=document.getElementById('detail-eval-btn');
    if(eb)eb.addEventListener('click',function(){openEvalFs(pid);});
  }
  if(lbList.length){var dhc=document.getElementById('dhc');if(dhc)dhc.addEventListener('click',function(){openLb(lbList,0,p.name);});}
  document.querySelectorAll('[data-lb]').forEach(function(el){
    el.addEventListener('click',function(){openLb(lbList,parseInt(this.dataset.lb),p.name);});
  });
  showView('project-detail');
}

/* ══ ADMIN TABS ══ */
function adminTab(tab){
  curAdminTab=tab;
  document.querySelectorAll('[data-admin-tab]').forEach(function(b){b.classList.toggle('active',b.dataset.adminTab===tab);});
  document.querySelectorAll('#view-admin .dash-tab').forEach(function(s){s.classList.remove('active');});
  g('admin-'+tab).classList.add('active');
  if(tab==='projects')renderAdminProjects();
  else if(tab==='jury')renderAdminJury();
  else if(tab==='evaluations')renderAdminEvals();
  else if(tab==='criteria')renderCriteriaEditor();
}
function sbox(icon,bg,col,num,lbl){
  var isZero=(num===0||num==='0');
  return '<div class="stat-box"><div class="stat-icon" style="background:'+bg+';">'+icon+'</div>'
    +'<div><div class="stat-num'+(isZero?' zero':'')+'">'+num+'</div><div class="stat-lbl">'+lbl+'</div></div></div>';
}

/* ══ ADMIN PROJECTS ══ */
function renderAdminProjects(){
  var pub=DB.evaluations.filter(function(e){return e.published;}).length;
  var evProj=Object.keys(DB.evaluations.reduce(function(a,e){if(e.published)a[e.projectId]=1;return a;},{})).length;
  g('admin-proj-stats').innerHTML=
    sbox('🏛','var(--cg)','var(--cyan)',DB.projects.length,t('stat_uploaded'))
    +sbox('✓','var(--grb)','var(--gr)',pub,t('stat_published'))
    +sbox('⏳','var(--amb)','var(--am)',DB.projects.length-evProj,t('stat_pending'));
  var grid=g('admin-projects-grid'),empty=g('admin-projects-empty');
  grid.innerHTML='';
  if(!DB.projects.length){empty.style.display='block';grid.style.display='none';return;}
  empty.style.display='none';grid.style.display='grid';
  DB.projects.forEach(function(p){
    var pub=DB.evaluations.filter(function(e){return e.projectId===p.id&&e.published;}).length;
    var imgs=(p.cover?1:0)+(p.images||[]).length;
    var card=document.createElement('div');card.className='pc';
    card.innerHTML='<div class="pc-img">'+(p.cover?'<img src="'+p.cover+'" loading="lazy">'
      :'<div class="pc-img-ph">🏛</div>')+'</div>'
      +'<div class="pc-body"><div class="pc-name">'+p.name+'</div>'
      +'<div class="pc-meta"><span>📷 '+imgs+'</span>'+(pub?'<span class="badge bg">'+pub+' '+t('published_eval')+'</span>':'<span class="badge ba">'+t('pending')+'</span>')+'</div>'
      +'<div class="pc-acts">'
      +'<button class="btn btn-ghost btn-sm" data-edit="'+p.id+'">✏️</button>'
      +'<button class="btn btn-danger btn-sm" data-del="'+p.id+'">'+t('del_project')+'</button>'
      +'</div></div>';
    grid.appendChild(card);
  });
  document.querySelectorAll('[data-edit]').forEach(function(btn){
    btn.addEventListener('click',function(){openEditProject(btn.dataset.edit);});
  });
  document.querySelectorAll('[data-del]').forEach(function(btn){
    btn.addEventListener('click',function(){
      if(!confirm(t('confirm_del_project')))return;
      var pid=btn.dataset.del;
      btn.disabled=true;
      api('admin_delete_project.php',{projectId:pid})
      .then(function(d){
        if(!d.ok){toast(d.error||'Error','err');btn.disabled=false;return;}
        toast(t('t_project_deleted'));
        return loadData();
      }).then(function(){renderAdminProjects();})
      .catch(function(){toast('Network error','err');btn.disabled=false;});
    });
  });
}
function openEditProject(pid){
  var p=DB.projects.filter(function(x){return x.id===pid;})[0];if(!p)return;
  editingProjectId=pid;
  resetProjectModal();
  g('proj-name-input').value=p.name;
  if(p.cover){
    stageCover={dataUrl:p.cover};
    g('cover-preview').src=p.cover;
    g('cover-preview-name').textContent=t('current_cover');
    g('cover-preview-wrap').style.display='block';
  }
  stageImgs=(p.images||[]).map(function(im,i){return {dataUrl:im.dataUrl,name:t('image')+' '+(i+1),desc:im.desc||''};});
  renderImgItems();
  if(g('btn-add-project'))g('btn-add-project').textContent=t('save_changes');
  openModal('modal-add-project');
}

/* ══ ADMIN JURY ══ */
function renderAdminJury(){
  var members=DB.users.filter(function(u){return u.role==='jury';});
  var totalPub=DB.evaluations.filter(function(e){return e.published;}).length;
  var totalDraft=DB.evaluations.filter(function(e){return !e.published;}).length;
  g('admin-jury-stats').innerHTML=
    sbox('👥','var(--vb)','var(--vi)',members.length,t('stat_jury_members'))
    +sbox('📋','var(--grb)','var(--gr)',totalPub,t('stat_published_evals'))
    +sbox('💾','var(--blb)','var(--bl)',totalDraft,t('stat_drafts'));
  var tbody=g('jury-tbody'),empty=g('jury-empty');
  tbody.innerHTML='';empty.style.display=members.length?'none':'block';
  members.forEach(function(m){
    var pub=DB.evaluations.filter(function(e){return e.juryId===m.id&&e.published;}).length;
    var tr=document.createElement('tr');
    tr.innerHTML='<td style="font-weight:600;">'+m.name+'</td>'
      +'<td style="font-family:\'IBM Plex Mono\',monospace;font-size:11px;direction:ltr;color:var(--t2);">'+m.email+'</td>'
      +'<td><div style="display:flex;align-items:center;gap:6px;">'
        +'<span style="font-family:\'IBM Plex Mono\',monospace;font-size:11px;direction:ltr;color:var(--cyan);background:var(--s3);padding:3px 8px;border-radius:4px;border:1px solid var(--b2);">••••••••</span>'
        +'<button class="btn btn-ghost btn-sm" data-pw-edit="'+m.id+'" style="padding:4px 8px;">✏️</button>'
      +'</div>'
      +'<div id="pw-edit-'+m.id+'" style="display:none;margin-top:6px;gap:6px;align-items:center;flex-wrap:wrap;">'
        +'<input id="pw-input-'+m.id+'" class="input" type="text" placeholder="'+t('change_pw_ph')+'" style="width:150px;padding:5px 9px;font-size:12px;direction:ltr;">'
        +'<button class="btn btn-primary btn-sm" data-pw-save="'+m.id+'">'+t('save_pw')+'</button>'
        +'<button class="btn btn-ghost btn-sm" data-pw-cancel="'+m.id+'">'+t('cancel_pw')+'</button>'
      +'</div></td>'
      +'<td><span class="badge bg">'+pub+' / '+DB.projects.length+'</span></td>'
      +'<td><button class="btn btn-danger btn-sm" data-rem="'+m.id+'">'+t('delete')+'</button></td>';
    tbody.appendChild(tr);
  });
  document.querySelectorAll('[data-pw-edit]').forEach(function(btn){
    btn.addEventListener('click',function(){
      var id=this.dataset.pwEdit;
      var editDiv=document.getElementById('pw-edit-'+id);
      editDiv.style.display=editDiv.style.display==='none'?'flex':'none';
    });
  });
  document.querySelectorAll('[data-pw-save]').forEach(function(btn){
    btn.addEventListener('click',function(){
      var id=this.dataset.pwSave;
      var input=document.getElementById('pw-input-'+id);
      var newPw=input.value.trim();
      if(!newPw||newPw.length<4){input.classList.add('err');toast(t('v_pw_short'),'err');return;}
      btn.disabled=true;
      api('admin_update_password.php',{userId:id,password:newPw})
      .then(function(d){
        if(!d.ok){toast(d.error||'Error','err');btn.disabled=false;return;}
        document.getElementById('pw-edit-'+id).style.display='none';
        toast(t('t_pw_changed'));btn.disabled=false;
      }).catch(function(){toast('Network error','err');btn.disabled=false;});
    });
  });
  document.querySelectorAll('[data-pw-cancel]').forEach(function(btn){
    btn.addEventListener('click',function(){document.getElementById('pw-edit-'+this.dataset.pwCancel).style.display='none';});
  });
  document.querySelectorAll('[data-rem]').forEach(function(btn){
    btn.addEventListener('click',function(){
      if(!confirm(t('confirm_del_member')))return;
      btn.disabled=true;
      api('admin_delete_jury.php',{userId:btn.dataset.rem})
      .then(function(d){
        if(!d.ok){toast(d.error||'Error','err');btn.disabled=false;return;}
        toast(t('t_member_deleted'));return loadData();
      }).then(function(){renderAdminJury();})
      .catch(function(){toast('Network error','err');btn.disabled=false;});
    });
  });
}

/* ══ ADMIN EVALS ══ */
function renderAdminEvals(){
  var c=g('admin-evals-list');c.innerHTML='';
  var members=DB.users.filter(function(u){return u.role==='jury';});
  if(!members.length){c.innerHTML='<div class="empty"><span class="empty-icon">👥</span><div class="empty-title">'+t('add_jury_first')+'</div></div>';return;}
  members.forEach(function(m){
    var myEvals=DB.evaluations.filter(function(e){return e.juryId===m.id;});
    var wrap=document.createElement('div');wrap.className='card';wrap.style.marginBottom='14px';
    wrap.innerHTML='<div class="card-hd"><div class="card-hd-title">'+m.name+'</div>'
      +'<span class="badge bg">'+myEvals.filter(function(e){return e.published;}).length+' '+t('published_eval')+'</span></div>'
      +'<div class="card-bd">'
      +(!myEvals.length?'<div style="font-size:13px;color:var(--t3);">'+t('no_eval_yet')+'</div>'
        :'<div class="tbl-wrap"><table class="tbl"><thead><tr>'
        +'<th>'+t('tbl_project')+'</th><th>'+t('tbl_score')+'</th><th>'+t('tbl_status')+'</th><th>'+t('tbl_action')+'</th>'
        +'</tr></thead><tbody>'
        +myEvals.map(function(ev){
          var p=DB.projects.filter(function(x){return x.id===ev.projectId;})[0];
          var avg=(num(ev.rawScore)/10).toFixed(1);
          return '<tr><td style="font-weight:600;">'+(p?p.name:t('project_default'))+'</td>'
            +'<td style="font-family:\'IBM Plex Mono\',monospace;color:var(--cyan);">'+avg+' / 10</td>'
            +'<td>'+(ev.published?'<span class="badge bg">'+t('published')+'</span>':'<span class="badge bb">'+t('draft')+'</span>')+'</td>'
            +'<td><button class="btn btn-danger btn-sm" data-cancel-eval="'+ev.id+'">'+t('cancel_eval')+'</button></td></tr>';
        }).join('')+'</tbody></table></div>')
      +'</div>';
    c.appendChild(wrap);
  });
  c.querySelectorAll('[data-cancel-eval]').forEach(function(btn){
    btn.addEventListener('click',function(){
      var evalId=this.dataset.cancelEval;
      var ev=DB.evaluations.filter(function(e){return e.id===evalId;})[0];
      var juror=DB.users.filter(function(u){return u.id===(ev&&ev.juryId);})[0];
      var proj=DB.projects.filter(function(p){return p.id===(ev&&ev.projectId);})[0];
      if(!confirm(t('confirm_cancel_eval_pre')+(juror?juror.name:t('juror_default_name'))+t('confirm_cancel_eval_mid')+(proj?proj.name:t('project_default'))+t('confirm_cancel_eval_suf')))return;
      btn.disabled=true;
      api('admin_cancel_evaluation.php',{evalId:evalId})
      .then(function(d){
        if(!d.ok){toast(d.error||'Error','err');btn.disabled=false;return;}
        toast(t('t_eval_cancelled'));return loadData();
      }).then(function(){renderAdminEvals();})
      .catch(function(){toast('Network error','err');btn.disabled=false;});
    });
  });
}

/* ══ CRITERIA EDITOR ══ */
function renderCriteriaEditor(){
  var c=g('admin-criteria');if(!c)return;
  var CRITERIA_AR=DEFAULT_CRITERIA.ar;var CRITERIA_EN=DEFAULT_CRITERIA.en;
  var custom=customCriteria||{ar:CRITERIA_AR,en:CRITERIA_EN};
  c.querySelector('.ph').innerHTML='<div class="ph-title">'+t('criteria_tab')+'</div><div class="ph-sub">'+t('criteria_sub')+'</div>';
  var editorDiv=c.querySelector('#criteria-editor');
  if(!editorDiv){editorDiv=document.createElement('div');editorDiv.id='criteria-editor';c.appendChild(editorDiv);}
  editorDiv.innerHTML=CRITERIA_AR.map(function(ar,i){
    return '<div class="card" style="margin-bottom:12px;">'
      +'<div class="card-hd" style="padding:10px 16px;"><div class="card-hd-title">'+t('criteria_q')+' '+(i+1)+'</div></div>'
      +'<div class="card-bd" style="padding:12px 16px;display:grid;grid-template-columns:1fr 1fr;gap:10px;">'
      +'<div><label class="field-label">'+t('criteria_ar_label')+'</label>'
      +'<textarea class="input crit-ar" data-idx="'+i+'" rows="3" style="resize:vertical;direction:rtl;">'+custom.ar[i]+'</textarea></div>'
      +'<div><label class="field-label">'+t('criteria_en_label')+'</label>'
      +'<textarea class="input crit-en" data-idx="'+i+'" rows="3" style="resize:vertical;direction:ltr;">'+custom.en[i]+'</textarea></div>'
      +'</div></div>';
  }).join('');
}

/* ══ UPLOAD MODAL HELPERS ══ */
function resetProjectModal(){
  g('proj-name-input').value='';stageCover=null;stageImgs=[];
  g('cover-preview-wrap').style.display='none';g('cover-input').value='';g('multi-input').value='';
  g('img-items-list').innerHTML='';g('multi-count').textContent='';
  fieldOk(g('proj-name-input'));
}
function renderImgItems(){
  var list=g('img-items-list');list.innerHTML='';
  stageImgs.forEach(function(img,i){
    var d=document.createElement('div');d.className='img-item';
    d.innerHTML='<img class="img-item-th" src="'+img.dataUrl+'">'
      +'<div class="img-item-body"><div class="img-item-name">'+img.name+'</div>'
      +'<textarea class="input" rows="2" placeholder="'+t('img_optional_desc')+'" data-idx="'+i+'" style="font-size:11px;padding:7px 9px;resize:none;margin-top:4px;">'+img.desc+'</textarea></div>'
      +'<button style="width:22px;height:22px;border-radius:5px;background:var(--reb);border:1px solid rgba(239,68,68,.22);color:var(--re);cursor:pointer;font-size:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:2px;" data-ri="'+i+'">✕</button>';
    list.appendChild(d);
  });
  list.querySelectorAll('[data-idx]').forEach(function(ta){
    ta.addEventListener('input',function(){stageImgs[parseInt(this.dataset.idx)].desc=this.value;});
  });
  list.querySelectorAll('[data-ri]').forEach(function(btn){
    btn.addEventListener('click',function(){
      stageImgs.splice(parseInt(this.dataset.ri),1);
      renderImgItems();
      g('multi-count').textContent=stageImgs.length?stageImgs.length+t('img_count_suffix'):'';
    });
  });
  g('multi-count').textContent=stageImgs.length?stageImgs.length+' / 19'+(stageImgs.length===19?t('img_max_label'):''):'';
}
g('cover-zone').onclick=function(){g('cover-input').click();};
g('cover-input').addEventListener('change',function(){
  if(!this.files||!this.files[0])return;
  var f=this.files[0];if(f.size>1048576){toast(t('cover_too_big'),'err');return;}
  readFile(f,function(url){stageCover={dataUrl:url};g('cover-preview').src=url;g('cover-preview-name').textContent='✓ '+f.name;g('cover-preview-wrap').style.display='block';});
});
g('multi-zone').onclick=function(){g('multi-input').click();};
g('multi-input').addEventListener('change',function(){
  if(!this.files)return;
  var files=Array.from(this.files),rem=19-stageImgs.length;
  if(!rem){toast(t('img_max'),'err');return;}
  var ok=files.filter(function(f){return f.size<=1048576;}).slice(0,rem);
  if(ok.length<files.length)toast((files.length-ok.length)+t('imgs_too_big'),'err');
  var done=0;
  ok.forEach(function(f){readFile(f,function(url){stageImgs.push({dataUrl:url,name:f.name,desc:''});done++;if(done===ok.length)renderImgItems();});});
  this.value='';
});

/* ══ ADD/EDIT PROJECT — real API ══ */
g('btn-add-project').onclick=function(){
  var ni=g('proj-name-input');var name=ni.value.trim();
  if(!name){fieldErr(ni,t('v_project_name'));return;}
  fieldOk(ni);
  document.querySelectorAll('#img-items-list [data-idx]').forEach(function(ta){stageImgs[parseInt(ta.dataset.idx)].desc=ta.value;});
  var images=stageImgs.map(function(i){return {dataUrl:i.dataUrl,desc:i.desc||''};});
  var btn=g('btn-add-project');btn.disabled=true;
  if(editingProjectId){
    api('admin_update_project.php',{projectId:editingProjectId,name:name,cover:stageCover?stageCover.dataUrl:null,images:images})
    .then(function(d){
      if(!d.ok){toast(d.error||'Error','err');btn.disabled=false;return;}
      closeModal('modal-add-project');closeEditMode();
      toast(t('t_project_updated'));
      if(d.projects){DB.projects=d.projects;}return loadData();
    }).then(function(){renderAdminProjects();btn.disabled=false;})
    .catch(function(){toast('Network error','err');btn.disabled=false;});
  } else {
    api('admin_create_project.php',{name:name,cover:stageCover?stageCover.dataUrl:null,images:images})
    .then(function(d){
      if(!d.ok){toast(d.error||'Error','err');btn.disabled=false;return;}
      closeModal('modal-add-project');toast(t('t_project_added'));
      if(d.projects){DB.projects=d.projects;}return loadData();
    }).then(function(){renderAdminProjects();renderPublic();btn.disabled=false;})
    .catch(function(){toast('Network error','err');btn.disabled=false;});
  }
};

/* ══ ADD JURY — real API ══ */
g('btn-add-jury').onclick=function(){
  var ni=g('jury-name-input'),ei=g('jury-email-input'),pi=g('jury-pass-input');
  var name=ni.value.trim(),email=ei.value.trim(),pass=pi.value;
  fieldOk(ni);fieldOk(ei);fieldOk(pi);
  if(!name){fieldErr(ni,t('v_name'));return;}
  if(!email||!email.includes('@')){fieldErr(ei,t('v_email'));return;}
  if(!pass||pass.length<6){fieldErr(pi,t('v_pass_short'));return;}
  var btn=g('btn-add-jury');btn.disabled=true;
  api('admin_create_jury.php',{name:name,email:email,password:pass})
  .then(function(d){
    if(!d.ok){
      if(d.error&&d.error.toLowerCase().includes('exist')){fieldErr(ei,t('v_email_exists'));}
      else{toast(d.error||'Error','err');}
      btn.disabled=false;return;
    }
    closeModal('modal-add-jury');toast(t('t_member_added'));
    if(d.users){DB.users=d.users;}return loadData();
  }).then(function(){if(g('admin-jury').classList.contains('active'))renderAdminJury();btn.disabled=false;})
  .catch(function(){toast('Network error','err');btn.disabled=false;});
};

/* ══ AUTH — real API ══ */
function doLogin(){
  var ei=g('login-email'),pi=g('login-pass');
  var email=ei.value.trim(),pass=pi.value;
  fieldOk(ei);fieldOk(pi);
  if(!email||!pass){toast(t('auth_error'),'err');return;}
  var btn=g('btn-login');btn.disabled=true;
  api('login.php',{email:email,password:pass})
  .then(function(d){
    if(!d.ok){
      g('auth-error').classList.add('show');
      ei.classList.add('err');pi.classList.add('err');
      btn.disabled=false;return;
    }
    g('auth-error').classList.remove('show');
    var user=d.user;
    if(d.csrfToken) setCsrfToken(d.csrfToken);
    var overlay=document.createElement('div');
    overlay.className='login-success-overlay';
    overlay.innerHTML='<div class="login-success-box">'
      +'<div class="login-success-icon">✓</div>'
      +'<div class="login-success-text">'+t('hi_prefix')+user.name+'</div>'
      +'<div class="login-success-sub">'+(user.role==='admin'?t('welcome_admin'):t('welcome_jury'))+'</div>'
      +'</div>';
    document.body.appendChild(overlay);
    return loadData().then(function(){
      setTimeout(function(){
        overlay.style.animation='successFade .35s ease forwards';
        setTimeout(function(){
          overlay.remove();btn.disabled=false;
          if(user.role==='admin'){showView('admin');renderAdminProjects();}
          else{g('jury-name').textContent=user.name;g('jury-avatar').textContent=(user.name||'J')[0];showView('jury');renderJuryProjects();}
        },350);
      },1100);
    });
  }).catch(function(){toast('Network error','err');btn.disabled=false;});
}

function doLogout(){
  api('logout.php',{}).then(function(){
    DB.currentUser=null;DB.users=[];DB.projects=[];DB.evaluations=[];
    g('login-email').value='';g('login-pass').value='';
    loadData().then(function(){showView('public');});
  }).catch(function(){
    DB.currentUser=null;g('login-email').value='';g('login-pass').value='';
    showView('public');
  });
}

/* ══ JURY RENDER ══ */
function juryTab(tab){
  document.querySelectorAll('[data-jury-tab]').forEach(function(b){b.classList.toggle('active',b.dataset.juryTab===tab);});
  document.querySelectorAll('#view-jury .dash-tab').forEach(function(s){s.classList.remove('active');});
  g('jury-'+tab).classList.add('active');
  if(tab==='projects')renderJuryProjects();else renderJuryMyEvals();
}
function getMyEval(pid){
  if(!DB.currentUser) return null;
  var myId = DB.currentUser.id; // "u3"
  return DB.evaluations.filter(function(e){
    return e.projectId === pid && (e.juryId === myId || e.juryId == myId);
  })[0] || null;
}
function renderJuryProjects(){
  var grid=g('jury-proj-grid'),empty=g('jury-proj-empty');
  grid.innerHTML='';
  if(!DB.projects.length){empty.style.display='block';grid.style.display='none';return;}
  empty.style.display='none';grid.style.display='grid';
  DB.projects.forEach(function(p){
    var ev=getMyEval(p.id);
    var badge=ev&&ev.published?'<span class="badge bg" style="position:absolute;bottom:7px;left:7px;">'+t('published')+'</span>'
      :ev?'<span class="badge bb" style="position:absolute;bottom:7px;left:7px;">'+t('draft')+'</span>':'';
    var btnCls=ev&&ev.published?'btn-success':ev?'btn-save':'btn-primary';
    var btnLbl=ev&&ev.published?t('view_eval'):ev?t('edit_btn'):t('eval_btn');
    var card=document.createElement('div');card.className='pc';
    card.innerHTML='<div class="pc-img" style="position:relative;">'
      +(p.cover?'<img src="'+p.cover+'" loading="lazy">'
        :'<div class="pc-img-ph">🏛</div>')+badge+'</div>'
      +'<div class="pc-body"><div class="pc-name">'+p.name+'</div>'
      +'<div class="pc-meta"><span>📷 '+((p.cover?1:0)+(p.images||[]).length)+'</span>'
      +(ev?'<span style="font-family:\'IBM Plex Mono\',monospace;color:var(--cyan);font-size:11px;">'+((num(ev.rawScore)/10).toFixed(1))+' / 10</span>':'')
      +'</div>'
      +'<button class="btn '+btnCls+' btn-sm btn-full" data-eval="'+p.id+'">'+btnLbl+'</button>'
      +'</div>';
    grid.appendChild(card);
  });
  document.querySelectorAll('[data-eval]').forEach(function(btn){
    btn.addEventListener('click',function(){openEvalFs(this.dataset.eval);});
  });
}
function renderJuryMyEvals(){
  var c=g('jury-evals-list'),empty=g('jury-evals-empty');
  if(!DB.currentUser){empty.style.display='block';return;}
  var myEvals=DB.evaluations.filter(function(e){return e.juryId===DB.currentUser.id;});
  c.innerHTML='';empty.style.display=myEvals.length?'none':'block';
  myEvals.forEach(function(ev){
    var p=DB.projects.filter(function(x){return x.id===ev.projectId;})[0];
    var pct=num(ev.rawScore)/MAX*100;
    var avg=(num(ev.rawScore)/10).toFixed(1);
    var wrap=document.createElement('div');wrap.className='card';wrap.style.marginBottom='12px';
    wrap.innerHTML='<div class="card-hd">'
      +'<div class="card-hd-title">'+(p?p.name:t('project_default'))+'</div>'
      +'<div style="text-align:'+(LANG==='ar'?'left':'right')+'"><div style="font-family:\'IBM Plex Mono\',monospace;font-size:20px;color:var(--cyan);font-weight:600;line-height:1;">'+avg+' / 10</div>'
      +'</div></div>'
      +'<div class="card-bd">'
      +'<div class="er-bar" style="margin-bottom:10px;"><div class="er-bar-fill" style="width:'+pct+'%"></div></div>'
      +(ev.published?'<span class="badge bg">'+t('published')+'</span>':'<span class="badge bb">'+t('draft')+'</span>')
      +(ev.comment?'<div class="er-comment" style="margin-top:10px;">'+ev.comment+'</div>':'')
      +'</div>';
    c.appendChild(wrap);
  });
}

/* ══ BINDINGS ══ */
g('btn-go-auth').onclick=function(){showView('auth');};
g('btn-back-public').onclick=function(){showView('public');};
g('btn-login').onclick=doLogin;
g('login-pass').addEventListener('keydown',function(e){if(e.key==='Enter')doLogin();});
g('detail-back').onclick=function(){showView('public');};
g('detail-logo-home').onclick=function(){showView('public');};
g('logo-home').onclick=function(){showView('public');};
g('btn-logout-admin').onclick=doLogout;
g('btn-logout-jury').onclick=doLogout;
g('btn-open-add-project').onclick=function(){resetProjectModal();closeEditMode();openModal('modal-add-project');};
g('btn-open-add-jury').onclick=function(){
  ['jury-name-input','jury-email-input','jury-pass-input'].forEach(function(id){g(id).value='';fieldOk(g(id));});
  openModal('modal-add-jury');
};
var btnSaveCrit=g('btn-save-criteria');
if(btnSaveCrit){
  btnSaveCrit.onclick=function(){
    var newAr=[],newEn=[];
    document.querySelectorAll('.crit-ar').forEach(function(ta){newAr.push(ta.value.trim()||DEFAULT_CRITERIA.ar[parseInt(ta.dataset.idx)]);});
    document.querySelectorAll('.crit-en').forEach(function(ta){newEn.push(ta.value.trim()||DEFAULT_CRITERIA.en[parseInt(ta.dataset.idx)]);});
    customCriteria={ar:newAr,en:newEn};
    toast(t('t_criteria_saved'));
  };
}
var btnResetCrit=g('btn-reset-criteria');
if(btnResetCrit){
  btnResetCrit.onclick=function(){
    if(!confirm(t('t_criteria_reset')+'?'))return;
    customCriteria=null;renderCriteriaEditor();toast(t('t_criteria_reset'));
  };
}
document.querySelectorAll('[data-admin-tab]').forEach(function(btn){btn.onclick=function(){adminTab(this.dataset.adminTab);};});
document.querySelectorAll('[data-jury-tab]').forEach(function(btn){btn.onclick=function(){juryTab(this.dataset.juryTab);};});
document.querySelectorAll('[data-close]').forEach(function(btn){btn.onclick=function(){closeModal(this.dataset.close);if(this.dataset.close==='modal-add-project')closeEditMode();};});
g('lang-btn').onclick=function(){toggleLang();};

/* ══ BOOT ══ */
loadData();

})();
</script>
</body>
</html>
