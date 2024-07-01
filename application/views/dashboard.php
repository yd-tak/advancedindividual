<!--begin::Container-->
<div id="kt_content_container" class="d-flex flex-column-fluid align-items-start container-xxl">
    <!--begin::Post-->
    <div class="content flex-row-fluid" id="kt_content">

        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Candidates</h5>
                        <p class="card-text"><?= $countcandidates ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Active Job Postings</h5>
                        <p class="card-text"><?= $countvacancies ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Scheduled Interviews</h5>
                        <p class="card-text"><?= $countinterviewsongoing ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card" style="position: relative;height: 400px;text-align: center;margin: auto;">
                    <div class="card-body">
                        <h5 class="card-title">Candidate Stages</h5>
                        <canvas id="candidateStagesChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" style="position: relative;height: 400px;text-align: center;margin: auto;">
                        <h5 class="card-title">Job Applications</h5>
                        <canvas id="jobApplicationsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card" style="position: relative;height: 400px;text-align: center;margin: auto;">
                    <div class="card-body">
                        <h5 class="card-title">Recruitment Metrics</h5>
                        <canvas id="recruitmentMetricsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body" style="position: relative;height: 400px;text-align: center;margin: auto;">
                        <h5 class="card-title">AI Processing</h5>
                        <canvas id="aiProcessingChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Top 5 Vacancies with Most Candidates</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Vacancy ID</th>
                                    <th>Title</th>
                                    <th>Department</th>
                                    <th>Candidate Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($topvacancies as $vacancy): ?>
                                    <tr>
                                        <td><?= $vacancy->id ?></td>
                                        <td><?= $vacancy->title ?></td>
                                        <td><?= $vacancy->name ?></td>
                                        <td><?= $vacancy->countdata ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Candidates per Department</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Candidate Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($countcandidatedepts as $dept): ?>
                                    <tr>
                                        <td><?= $dept->department ?></td>
                                        <td><?= $dept->countdata ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Job Postings per Department</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Job Postings Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($countvacancydepts as $dept): ?>
                                    <tr>
                                        <td><?= $dept->department ?></td>
                                        <td><?= $dept->countdata ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Time to Hire per Department</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Avg. Time to Hire (Days)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($timetohiredepts as $dept): ?>
                                    <tr>
                                        <td><?= $dept->department ?></td>
                                        <td><?= $dept->avgdata ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Offer Acceptance Rate per Department</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Offer Acceptance Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($offeracceptanceratedepts as $dept): ?>
                                    <tr>
                                        <td><?= $dept->department ?></td>
                                        <td><?= number_format($dept->offeracceptancerate * 100, 2) ?>%</td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Offer Acceptance Rate Globally</h5>
                        <p class="card-text"><?= number_format($offeracceptancerate * 100, 2) ?>%</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Interviews Done</h5>
                        <p class="card-text"><?= $countinterviewsdone ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Interviews Done per Department</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Department</th>
                                    <th>Interviews Count</th>
                                    <th>Credits Used</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($countinterviewdonedepts as $dept): ?>
                                    <tr>
                                        <td><?= $dept->department ?></td>
                                        <td><?= $dept->countdata ?></td>
                                        <td><?= $dept->sumdata ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function () {
        // Data from the controller
        const candidateStagesData = <?= json_encode($countcandidatestages) ?>;
        const jobApplicationsData = <?= json_encode($countvacancydepts) ?>;
        const recruitmentMetricsData = {
            timetohire: <?= json_encode($timetohire) ?>,
            timetohiredepts: <?= json_encode($timetohiredepts) ?>
        };
        const aiProcessingData = {
            cvProcessed: <?= $countcandidates ?>,
            interviewsDone: <?= $countinterviewsdone ?>,
            testsDone: <?= $countinterviewsongoing ?>
        };

        // Candidate Stages Chart
        const candidateStagesCtx = document.getElementById('candidateStagesChart').getContext('2d');
        new Chart(candidateStagesCtx, {
            type: 'bar',
            data: {
                labels: candidateStagesData.map(item => item.stage),
                datasets: [{
                    label: '# of Candidates',
                    data: candidateStagesData.map(item => item.countdata),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Job Applications Chart
        const jobApplicationsCtx = document.getElementById('jobApplicationsChart').getContext('2d');
        new Chart(jobApplicationsCtx, {
            type: 'pie',
            data: {
                labels: jobApplicationsData.map(item => item.department),
                datasets: [{
                    label: '# of Applications',
                    data: jobApplicationsData.map(item => item.countdata),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });

        // Recruitment Metrics Chart
        const recruitmentMetricsCtx = document.getElementById('recruitmentMetricsChart').getContext('2d');
        new Chart(recruitmentMetricsCtx, {
            type: 'line',
            data: {
                labels: recruitmentMetricsData.timetohiredepts.map(item => item.department),
                datasets: [{
                    label: 'Time to Hire (Days)',
                    data: recruitmentMetricsData.timetohiredepts.map(item => item.avgdata),
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // AI Processing Chart
        const aiProcessingCtx = document.getElementById('aiProcessingChart').getContext('2d');
        new Chart(aiProcessingCtx, {
            type: 'doughnut',
            data: {
                labels: ['CVs Processed', 'Interviews Done', 'Tests Done'],
                datasets: [{
                    label: 'AI Processing',
                    data: [aiProcessingData.cvProcessed, aiProcessingData.interviewsDone, aiProcessingData.testsDone],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    });
</script>
