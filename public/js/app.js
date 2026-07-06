// ===== Sidebar =====
function toggleSidebar(){
  const s = document.getElementById('sidebar');
  const o = document.getElementById('sidebar-overlay');
  if (s.classList.contains('-translate-x-full')) {
    s.classList.remove('-translate-x-full');
    o.classList.remove('hidden');
  } else {
    s.classList.add('-translate-x-full');
    o.classList.add('hidden');
  }
}

// ===== Modal (besar - untuk form create/edit) =====
function openModalRemote(url){
  fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(res => res.text())
    .then(html => {
      document.getElementById('modal-content').innerHTML = html;
      document.getElementById('modal-overlay').classList.remove('hidden');
    })
    .catch(() => toast('Gagal memuat form'));
}

// ===== Modal kecil (detail) =====
function openModalSmRemote(url){
  fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
    .then(res => res.text())
    .then(html => {
      document.getElementById('modal-sm-content').innerHTML = html;
      document.getElementById('modal-sm-overlay').classList.remove('hidden');
    })
    .catch(() => toast('Gagal memuat detail'));
}

function closeModal(){
  document.getElementById('modal-overlay').classList.add('hidden');
  document.getElementById('modal-sm-overlay').classList.add('hidden');
}

// ===== Toast =====
function toast(msg){
  const c = document.getElementById('toast-container');
  const t = document.createElement('div');
  t.className = 'px-4 py-3 bg-slate-800 text-white text-sm rounded-xl shadow-lg flex items-center gap-2 fade-in';
  t.innerHTML = `<i class="ph-fill ph-check-circle text-emerald-400 text-lg"></i> ${msg}`;
  c.appendChild(t);
  setTimeout(() => { t.style.opacity = '0'; setTimeout(() => t.remove(), 300); }, 3000);
}
