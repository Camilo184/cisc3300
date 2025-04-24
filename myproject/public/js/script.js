$(document).ready(function () {
    // Mobile menu toggle
    $('.hamburger').on('click', function () {
        $('.nav-links').toggleClass('active');
        $(this).toggleClass('active');
    });

    // Fetch projects from API
    fetchProjects();

    // Project filtering
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

    // Contact form submission (updated)
    $('#contact-form').on('submit', function (e) {
        e.preventDefault();

        // Clear previous error messages
        $('#name-error, #email-error, #message-error').text('');

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
            $('#email-error').text('That email doesn’t look right.');
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
            url: 'api/messages',
            method: 'POST',
            contentType: 'application/json',
            data: JSON.stringify(formData),
            success: function (res) {
                if (res.success) {
                    alert('Thanks! Your message has been sent.');
                    $('#contact-form')[0].reset();
                } else {
                    alert('Error: ' + (res.error || 'Something went wrong.'));
                }
            },
            error: function (xhr) {
                let msg = 'Something went wrong.';
                try {
                    const res = JSON.parse(xhr.responseText);
                    if (res && res.error) {
                        msg = res.error;
                    }
                } catch (_) { }
                alert('Error: ' + msg);
            },
            complete: function () {
                submitBtn.prop('disabled', false).text(originalText);
            }
        });
    });

    function fetchProjects(category = null) {
        let url = 'api/projects';
        if (category) {
            url += '?category=' + category;
        }

        $('#projects-container').html('<div class="loading">Loading projects</div>');

        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                displayProjects(response);
            },
            error: function (xhr, status, error) {
                console.error('AJAX Error:', status, error);
                $('#projects-container').html('<div class="api-error">Error loading projects. Please try again later.</div>');
            }
        });
    }

    function displayProjects(data) {
        const container = $('#projects-container');
        container.empty();

        if (data.records && data.records.length > 0) {
            data.records.forEach(function (project) {
                const tagsHtml = project.tags.map(tag => `<span>${tag}</span>`).join('');

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
                                <a href="${project.demo_link}" class="btn btn-sm">Demo</a>
                                <a href="${project.code_link}" class="btn btn-sm">Code</a>
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
});
