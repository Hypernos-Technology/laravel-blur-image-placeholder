const onImageLoaded = (evt) => {
    evt.target.classList.add("loaded");
};

let blurImagePlaceholderObserver = new IntersectionObserver(function (entries, observer) {
    entries.forEach(function (entry) {
        if (!entry.isIntersecting) return

        let element = entry.target;
        element.src = element.dataset.src;

        element.addEventListener("load", onImageLoaded);

        blurImagePlaceholderObserver.unobserve(element);
    });
}, {
    rootMargin: "100px 0px",
});

let blurImagePlaceholder = [].slice.call(document.querySelectorAll(".blur-image-placeholder > img"));
blurImagePlaceholder.forEach(lazyImage => blurImagePlaceholderObserver.observe(lazyImage));
