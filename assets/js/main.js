async function postData(url = "", data = {}) {
    // Default options are marked with *
    const response = await fetch(url, {
        method: "POST",
        mode: "cors",
        cache: "no-cache",
        credentials: "same-origin",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
    });
    return response.json();
}
const currActiveIndex = localStorage.getItem('active-item');
const preActiveIndex = localStorage.getItem('pre-active-item');
if (currActiveIndex) {
    const currActiveEl = $(".navbar-nav").find(`[data-active='${currActiveIndex}']`);
    const preActiveEl = $(".navbar-nav").find(`[data-active='${preActiveIndex}']`);
    preActiveEl.removeClass('active');
    currActiveEl.addClass('active');
} else {
    localStorage.setItem('active-item', '1');
    localStorage.setItem('pre-active-item', '0');
    const currActiveEl = $(".navbar-nav").find(`[data-active='1']`);
    currActiveEl.addClass('active');
}

$('.nav-link').on('click', (el) => {
    // el.preventDefault();
    const li = $(el.target).closest('li');
    const preActiveIndex = localStorage.getItem('active-item');
    const currActiveIndex = $(li).data("active");
    localStorage.setItem('active-item', currActiveIndex);
    localStorage.setItem('pre-active-item', preActiveIndex);
})
