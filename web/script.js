// Wait for the DOM to be fully loaded

  
    
    // Smooth scrolling for navigation links
   
    
  
    // Form validation
    const contactForm = document.getElementById("contact-form")
  
    if (contactForm) {
      contactForm.addEventListener("submit", (e) => {
        e.preventDefault()
  
        const nameInput = document.getElementById("name")
        const emailInput = document.getElementById("email")
        const messageInput = document.getElementById("message")
  
        let isValid = true
  
        // Simple validation
        if (nameInput.value.trim() === "") {
          alert("Please enter your name")
          isValid = false
        } else if (emailInput.value.trim() === "") {
          alert("Please enter your email")
          isValid = false
        } else if (!isValidEmail(emailInput.value)) {
          alert("Please enter a valid email")
          isValid = false
        } else if (messageInput.value.trim() === "") {
          alert("Please enter a message")
          isValid = false
        }
  
        if (isValid) {
          // In a real application, you would send the form data to a server here
          alert("Thank you for your message! I will get back to you soon.")
          contactForm.reset()
        }
      })
    }
  
    // Email validation helper function
    function isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
      return emailRegex.test(email)
    }
  
    // Add active class to nav links based on scroll position
    window.addEventListener("scroll", () => {
      const scrollPosition = window.scrollY
  
      // Get all sections
      const sections = document.querySelectorAll("section")
  
      sections.forEach((section) => {
        const sectionTop = section.offsetTop - 100
        const sectionHeight = section.offsetHeight
        const sectionId = section.getAttribute("id")
  
        if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
          document.querySelector(`.nav-links a[href="#${sectionId}"]`).classList.add("active")
        } else {
          document.querySelector(`.nav-links a[href="#${sectionId}"]`).classList.remove("active")
        }
      })
    })
  
  
  