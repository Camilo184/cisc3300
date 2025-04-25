$(document).ready(function () {
  $('.hamburger').on('click', function () {
      $('.nav-links').toggleClass('active');
      $(this).toggleClass('active');
  });

  fetchProjects();

  $('.filter-btn').on('click', function () {
      const filter = $(this).data('filter');

      $('.filter-btn').removeClass('active');
      $(this).addClass('active');

      if (filter === 'all') {
          fetchProjects();
      } else {
          fetchProjects(filter);
      }
  });


  function fetchProjects(category = null) {
      let url = '/api/projects';
      if (category) {
          url += '?category=' + category;
      }

      $('.projects-grid').html('<div class="loading">Loading projects...</div>');

      $.ajax({
          url: url,
          method: 'GET',
          success: function (response) {
              console.log("Projects API Response:", response); // Debug log
              displayProjects(response);
          },
          error: function (xhr, status, error) {
              console.error('AJAX Error:', status, error);
              $('.projects-grid').html('<div class="api-error">Error loading projects. Please try again later.</div>');
          }
      });
  }

  function displayProjects(data) {
      console.log("Displaying projects:", data); // Debug log
      const container = $('.projects-grid');
      container.empty();

      if (data.success && data.projects && data.projects.length > 0) {
          data.projects.forEach(function (project) {
              let tagsArray = typeof project.tags === 'string' ? project.tags.split(',') : project.tags;
              const tagsHtml = tagsArray.map(tag => `<span>${tag.trim()}</span>`).join('');

              const projectHtml = `
                  <div class="project-card" data-category="${project.category}">
                      <img src="${project.image}" alt="${project.title}">
                      <div class="project-info">
                          <h3>${project.title}</h3>
                          <p>${project.description}</p>
                          <div class="project-tags">
                              ${tagsHtml}
                          </div>
                          <div class="project-links">
                              <a href="${project.demo_link}" class="btn btn-sm" target="_blank">Demo</a>
                              <a href="${project.code_link}" class="btn btn-sm" target="_blank">Code</a>
                          </div>
                      </div>
                  </div>
              `;

              container.append(projectHtml);
          });
      } else {
          container.html('<p>No projects found.</p>');
      }
  }

});
  $('#contact-form').on('submit', function (e) {
      e.preventDefault();

      $('#name-error, #email-error, #message-error').text('');
      $('#form-status').text('').removeClass('success error');

      const name = $('#name').val().trim();
      const email = $('#email').val().trim();
      const message = $('#message').val().trim();

      let hasError = false;

      if (!name) {
          $('#name-error').text('Please enter your name.');
          hasError = true;
      }
      if (!email) {
          $('#email-error').text('Please enter your email.');
          hasError = true;
      } else if (!isValidEmail(email)) {
          $('#email-error').text('That email doesnt look right.');
          hasError = true;
      }
      if (!message) {
          $('#message-error').text('Please enter a message.');
          hasError = true;
      }

      if (hasError) return;

      const formData = {
          name,
          email,
          message
      };

      const submitBtn = $(this).find('button[type="submit"]');
      const originalText = submitBtn.text();
      submitBtn.prop('disabled', true).text('Sending...');

      $.ajax({
          url: '/api/messages/index.php',
          method: 'POST',
          contentType: 'application/json',
          data: JSON.stringify(formData),
          success: function (res) {
              if (res.success) {
                  $('#form-status').text('Thanks! Your message has been sent.').addClass('success');
                  $('#contact-form')[0].reset();
              } else {
                  const errorMsg = Array.isArray(res.error) ? res.error.join(', ') : (res.error || 'Something went wrong.');
                  $('#form-status').text('Error: ' + errorMsg).addClass('error');
              }
          },
          error: function (xhr) {
              let msg = 'Something went wrong.';
              try {
                  const res = JSON.parse(xhr.responseText);
                  if (res && res.error) {
                      msg = Array.isArray(res.error) ? res.error.join(', ') : res.error;
                  }
              } catch (_) { }
              $('#form-status').text('Error: ' + msg).addClass('error');
          },
          complete: function () {
              submitBtn.prop('disabled', false).text(originalText);
          }
      });
  });

  function fetchProjects(category = null) {
    let url = '/api/projects';
    if (category) {
        url += '?category=' + category;
    }

    $('.projects-grid').html('<div class="loading">Loading projects...</div>');

    $.ajax({
        url: url,
        method: 'GET',
        success: function (response) {
            displayProjects(response);
        },
        error: function (xhr, status, error) {
            console.error('AJAX Error:', status, error);
            $('.projects-grid').html('<div class="api-error">Error loading projects. Please try again later.</div>');
        }
    });
}

function displayProjects(data) {
    const container = $('.projects-grid');
    container.empty();

    if (data.success && data.projects && data.projects.length > 0) {
        data.projects.forEach(function (project) {
            let tagsArray = typeof project.tags === 'string' ? project.tags.split(',') : project.tags;
            const tagsHtml = tagsArray.map(tag => `<span>${tag.trim()}</span>`).join('');

            const projectHtml = `
                <div class="project-card" data-category="${project.category}">
                    <img src="${project.image}" alt="${project.title}">
                    <div class="project-info">
                        <h3>${project.title}</h3>
                        <p>${project.description}</p>
                        <div class="project-tags">
                            ${tagsHtml}
                        </div>
                        <div class="project-links">
                            <a href="${project.demo_link}" class="btn btn-sm" target="_blank">Demo</a>
                            <a href="${project.code_link}" class="btn btn-sm" target="_blank">Code</a>
                        </div>
                    </div>
                </div>
            `;

            container.append(projectHtml);
        });
    } else {
        container.html('<p>No projects found.</p>');
    }
}

  function isValidEmail(email) {
      const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return regex.test(email);
  }
  

;