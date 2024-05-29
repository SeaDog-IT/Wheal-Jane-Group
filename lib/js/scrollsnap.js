var targets = document.querySelectorAll("section");
var obsOptions = {
  root: null, // measure against the viewport
  threshold: 0.5 // how much of the element should be visible before handler is triggered
};

let handler = (entries, opts) => {
  entries.forEach((entry) => {
    if (entry.intersectionRatio > opts.thresholds[0]) {
      const classesToRemove = findClassesWithActive(document.body.classList);
      if (classesToRemove.length > 0) {
        document.body.classList.remove(classesToRemove);
      }
      document.body.classList.add(entry.target.id + "-active");
    }
  });
};

targets.forEach((el) => {
  var observer = new IntersectionObserver(handler, obsOptions);
  observer.observe(el);
});

function findClassesWithActive([...classList]) {
  return classList.filter((c) => c.includes("-active"));
}