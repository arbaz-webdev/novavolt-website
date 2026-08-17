/* NovaVolt — progressive enhancements.
   Markup stays fully editable; every effect fails open (content is never hidden). */
(function () {
  'use strict';
  var reduce = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* 1. Pulsing "live" dot — replaces a leading bullet inside .nv-live */
  document.querySelectorAll('.nv-live').forEach(function (el) {
    if (el.dataset.nvDot) return;
    el.dataset.nvDot = '1';
    el.innerHTML = el.innerHTML.replace(/^\s*●\s*/, '<span class="nv-livedot" aria-hidden="true"></span>');
  });

  /* 2. Logo marquee — wraps whatever logos the editor has entered.
        Duplicates the row once so the loop is seamless. */
  if (reduce) return;
  var logos = document.querySelectorAll('p.nv-logo');
  if (logos.length < 4) return;
  var row = logos[0].parentElement;
  if (!row || row.dataset.nvMarquee) return;
  row.dataset.nvMarquee = '1';

  var track = document.createElement('div');
  track.className = 'nv-mtrack';
  while (row.firstChild) { track.appendChild(row.firstChild); }

  var clone = track.cloneNode(true);
  clone.setAttribute('aria-hidden', 'true');

  var scroller = document.createElement('div');
  scroller.className = 'nv-mscroll';
  scroller.appendChild(track);
  scroller.appendChild(clone);

  row.classList.add('nv-marquee');
  row.appendChild(scroller);
})();


/* 3. Sticky header shade — adds .nv-stuck once the page is scrolled */
(function () {
  'use strict';
  var header = document.querySelector('.wp-site-blocks > header.wp-block-template-part');
  if (!header) return;
  var ticking = false;
  function update() { header.classList.toggle('nv-stuck', window.scrollY > 8); ticking = false; }
  window.addEventListener('scroll', function () {
    if (!ticking) { window.requestAnimationFrame(update); ticking = true; }
  }, { passive: true });
  update();
})();
