
        // Fetch upcoming matches from a free API and display them in a table
        async function fetchUpcomingMatches() {
            const loadingElem = document.getElementById("loadingMatches");
            const table = document.getElementById("upcomingMatchesTable");
            const tbody = document.getElementById("matchesBody");

            try {
                // Example free API with no key: Scorebat video API (matches endpoint)
                const response = await fetch(
                    "https://www.scorebat.com/video-api/v3/"
                );
                if (!response.ok) throw new Error("Network response was not ok");

                const data = await response.json();

                // Clear loading text
                loadingElem.style.display = "none";
                table.style.display = "table";

                // The API returns videos with match info, we'll parse first 40 matches
                let count = 0;
                for (const video of data.response) {
                    if (count >= 40) break;

                    const title = video.title || "Unknown Match";
                    const competition = video.competition || "Unknown Competition";

                    // The API returns date/time in published or date property
                    let dateTimeStr = video.date || video.published || "";
                    let dateObj = dateTimeStr ? new Date(dateTimeStr) : null;

                    let date = dateObj
                        ? dateObj.toLocaleDateString(undefined, {
                              year: "numeric",
                              month: "short",
                              day: "numeric",
                          })
                        : "TBD";
                    let time = dateObj
                        ? dateObj.toLocaleTimeString(undefined, {
                              hour: "2-digit",
                              minute: "2-digit",
                          })
                        : "TBD";

                    const tr = document.createElement("tr");

                    const matchCell = document.createElement("td");
                    matchCell.textContent = title;

                    const dateCell = document.createElement("td");
                    dateCell.textContent = date;

                    const timeCell = document.createElement("td");
                    timeCell.textContent = time;

                    const compCell = document.createElement("td");
                    compCell.textContent = competition;

                    tr.appendChild(matchCell);
                    tr.appendChild(dateCell);
                    tr.appendChild(timeCell);
                    tr.appendChild(compCell);

                    tbody.appendChild(tr);

                    count++;
                }

                if (count === 0) {
                    loadingElem.style.display = "block";
                    loadingElem.textContent = "No upcoming matches found.";
                    table.style.display = "none";
                }
            } catch (error) {
                loadingElem.textContent =
                    "Failed to load upcoming matches. Please try again later.";
                console.error("Error fetching matches:", error);
            }
        }

        // Expanded list of leagues for future use (not used in live score anymore)
        const leagues = [
            "English Premier League",
            "Spanish La Liga",
            "German Bundesliga",
            "Italian Serie A",
            "French Ligue 1",
            "UEFA Champions League",
            "Dutch Eredivisie",
            "Portuguese Primeira Liga",
            "Turkish Super Lig",
            "Belgian Pro League",
            "Scottish Premiership",
            "Russian Premier League",
            "Greek Super League",
            "Swiss Super League",
            "Austrian Bundesliga",
            "MLS",
            "Brazil Serie A",
            "Argentina Primera Division",
            "Mexican Liga MX",
            "Chinese Super League",
            "Japanese J1 League",
            "Korean K League 1",
            "Australian A-League",
            "South African PSL",
            "Danish Superliga",
            "Norwegian Eliteserien",
            "Swedish Allsvenskan",
            "Polish Ekstraklasa",
            "Czech First League",
            "Croatian HNL",
            "Serbian SuperLiga"
        ];

        // Load upcoming matches on page load
        document.addEventListener("DOMContentLoaded", fetchUpcomingMatches);

        // Contact Us Modal logic
        document.addEventListener("DOMContentLoaded", function () {
            var contactUsLink = document.getElementById('contactUsLink');
            var contactUsModal = new bootstrap.Modal(document.getElementById('contactUsModal'));
            var contactForm = document.querySelector('#contactUsModal form');
            var contactSuccess = document.getElementById('contactSuccess');

            contactUsLink.addEventListener('click', function (e) {
                e.preventDefault();
                contactForm.reset();
                contactSuccess.style.display = 'none';
                contactUsModal.show();
            });

            contactForm.addEventListener('submit', function (e) {
                e.preventDefault();
                contactSuccess.style.display = 'block';
                setTimeout(function () {
                    contactUsModal.hide();
                }, 1800);
            });
        });
