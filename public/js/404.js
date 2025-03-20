            // Create floating particles
            function createParticles() {
                const particlesContainer = document.querySelector(".particles");
                const numberOfParticles = 50;

                for (let i = 0; i < numberOfParticles; i++) {
                    const particle = document.createElement("div");
                    particle.className = "particle";

                    // Random size between 4 and 12 pixels
                    const size = Math.random() * 8 + 4;
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;

                    // Random position
                    particle.style.left = `${Math.random() * 100}%`;
                    particle.style.top = `${Math.random() * 100}%`;

                    // Random animation
                    const duration = Math.random() * 20 + 10;
                    const delay = Math.random() * 5;

                    particle.style.animation = `float ${duration}s ${delay}s infinite linear`;

                    particlesContainer.appendChild(particle);
                }
            }

            // Initialize particles on load
            window.addEventListener("load", createParticles);

            // Add hover effect to error code
            const errorCode = document.querySelector(".error-code");
            errorCode.addEventListener("mouseover", () => {
                errorCode.style.transform = "scale(1.1) rotate(5deg)";
                errorCode.style.transition = "transform 0.3s ease";
            });

            errorCode.addEventListener("mouseout", () => {
                errorCode.style.transform = "scale(1) rotate(0deg)";
            });