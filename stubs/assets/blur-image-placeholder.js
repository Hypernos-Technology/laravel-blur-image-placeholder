const a=e=>{e.target.classList.add("loaded")};let l=new IntersectionObserver(function(e,c){e.forEach(function(t){if(!t.isIntersecting)return;let r=t.target;r.src=r.dataset.src,r.addEventListener("load",a),l.unobserve(r)})},{rootMargin:"100px 0px"}),o=[].slice.call(document.querySelectorAll(".blur-image-placeholder>img"));o.forEach(e=>l.observe(e));
