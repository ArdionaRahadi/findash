// Create floating locks
function createLocks() {
  const locksContainer = document.querySelector(".locks-container");
  const numberOfLocks = 15;

  for (let i = 0; i < numberOfLocks; i++) {
    const lock = document.createElement("div");
    lock.className = "lock";

    // Random position
    lock.style.left = `${Math.random() * 100}vw`;
    lock.style.top = `${Math.random() * 100}vh`;

    // Random size
    const size = Math.random() * 20 + 20;
    lock.style.width = `${size}px`;
    lock.style.height = `${size}px`;

    // Random animation delay
    lock.style.animationDelay = `${Math.random() * 5}s`;

    locksContainer.appendChild(lock);
  }
}

// Create dots
function createDots() {
  const numberOfDots = 20;
  const body = document.body;

  for (let i = 0; i < numberOfDots; i++) {
    const dot = document.createElement("div");
    dot.className = "dot";

    const size = Math.random() * 15 + 5;
    dot.style.width = `${size}px`;
    dot.style.height = `${size}px`;

    dot.style.left = `${Math.random() * 100}vw`;
    dot.style.top = `${Math.random() * 100}vh`;

    dot.style.animation = `float ${Math.random() * 10 + 10}s linear infinite`;
    dot.style.opacity = Math.random() * 0.5 + 0.1;

    body.appendChild(dot);
  }
}

// Initialize
createLocks();
createDots();
