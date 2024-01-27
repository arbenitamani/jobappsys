<?php

$selectedOption = isset($_GET['option']) ? $_GET['option'] : 'Users';

function renderContent($selectedOption)
{
    switch ($selectedOption) {
        case 'Users':
            return '<div class="users">Users Content</div>';
        case 'Applications':
            return '<div class="applications">Applications Content</div>';
        case 'Interviews':
            return '<div class="interviews">Interviews Content </div>';
        case 'JobPosts':
            return '<div class="jobposts">JobPosts Content</div>';
        case 'Skills':
            return '<div class="skills">Skills Content </div>';
        default:
            return '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="adminpanel.css">
</head>

<body>
    <div class="dash-wrapper">
        <div class="dash-all">
            <div class="dash-left">
                <h1>WorkWise</h1>
                <ul>
                    <li><a href="?option=Users">
                            <svg width="30px" height="30px" viewBox="0 0 24 24" fill="white"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z"
                                    stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="white"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Users</a></li>
                    <li><a href="?option=Applications">
                            <svg width="30px" height="30px" fill="white" version="1.1" id="Layer_1"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 480 480">
                                <g>
                                    <g>
                                        <path d="M413.648,74.336L341.664,2.352C340.216,0.896,338.216,0,336,0H104C81.944,0,64,17.944,64,40v344c0,22.056,17.944,40,40,40
            h88v56h16v-56h120c4.416,0,8-3.576,8-8v-40c0-14.88,10.216-27.432,24-30.984V416v64h16v-56c22.056,0,40-17.944,40-40V80
            C416,77.784,415.104,75.784,413.648,74.336z M344,27.312L388.688,72H344V27.312z M400,384c0,13.232-10.768,24-24,24v-72
            c0-4.424-3.584-8-8-8c-26.472,0-48,21.528-48,48v32H104c-13.232,0-24-10.768-24-24V40c0-13.232,10.768-24,24-24h224v64
            c0,4.424,3.584,8,8,8h64V384z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <path d="M224,48H112c-4.416,0-8,3.576-8,8v112c0,4.424,3.584,8,8,8h32h48h32c4.416,0,8-3.576,8-8V56C232,51.576,228.416,48,224,48
            z M184,160h-32v-16c0-8.824,7.176-16,16-16c8.824,0,16,7.176,16,16V160z M160,104c0-4.416,3.592-8,8-8s8,3.584,8,8s-3.592,8-8,8
            S160,108.416,160,104z M216,160h-16v-16c0-10.488-5.136-19.72-12.952-25.56c3.064-4.032,4.952-9,4.952-14.44
            c0-13.232-10.768-24-24-24s-24,10.768-24,24c0,5.44,1.888,10.408,4.952,14.44C141.136,124.28,136,133.512,136,144v16h-16V64h96
            V160z" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="248" y="72" width="40" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="248" y="104" width="48" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="312" y="104" width="40" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="248" y="136" width="104" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="144" y="200" width="64" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="224" y="200" width="48" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="288" y="200" width="80" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="112" y="232" width="64" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="192" y="232" width="128" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="336" y="232" width="32" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="112" y="264" width="32" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="160" y="264" width="96" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="272" y="264" width="96" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="112" y="296" width="32" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="160" y="296" width="96" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="272" y="296" width="96" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="112" y="328" width="72" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="200" y="328" width="112" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="112" y="360" width="32" height="16" />
                                    </g>
                                </g>
                                <g>
                                    <g>
                                        <rect x="160" y="360" width="136" height="16" />
                                    </g>
                                </g>
                            </svg>
                            Applications</a></li>
                    <li><a href="?option=Interviews">
                            <svg width="30px" height="30px" fill="white" version="1.1" id="Capa_1"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 943.118 943.118">
                                <g>
                                    <g>
                                        <g>
                                            <path
                                                d="M54.182,670.915v189.128c0,11.047,8.955,20,20,20h362.347c-3.137-6.688-4.899-14.143-4.899-22.006V670.915H54.182z" />
                                            <path d="M30,639.904h24.182h377.446V622.67v-24.418c0-0.229,0.007-0.456,0.009-0.685c0.107-15.218,3.8-29.6,10.277-42.337
                c2.796-5.496,6.107-10.688,9.873-15.506c4.478-5.729,9.597-10.934,15.245-15.507c16.361-13.248,37.182-21.197,59.827-21.197
                h22.555v-43.313c0-32.846-26.627-59.473-59.473-59.473h-53.809c-10.504,0-19.628,7.229-22.029,17.455l-25.013,106.529
                l-3.642,15.507l-2.578,10.977c-0.36,1.538-0.785,3.049-1.271,4.528h-16.584c-0.183-5.188-0.711-10.367-1.577-15.506
                c-0.148-0.892-0.306-1.779-0.476-2.666l-3.326-12.841l-19.571-75.542l15.62-34.473c2.965-6.545-1.82-13.968-9.006-13.968h-33.525
                c-7.186,0-11.972,7.423-9.006,13.968l15.62,34.473l-20.313,75.542l-3.086,11.478c-0.268,1.339-0.506,2.683-0.728,4.029
                c-0.848,5.14-1.36,10.317-1.527,15.506h-15.88c-0.484-1.48-0.909-2.99-1.271-4.528l-2.578-10.977l-3.641-15.508l-25.013-106.525
                c-2.401-10.227-11.524-17.455-22.029-17.455h-53.808c-32.846,0-59.473,26.627-59.473,59.473v64.513v15.506v15.506H30
                c-16.568,0-30,13.431-30,30v24.674C0,626.474,13.432,639.904,30,639.904z" />
                                            <path d="M329.919,368.094c73.717,0,133.477-59.76,133.477-133.477V92.744c0-18.391-16.561-32.347-34.686-29.233
                c-39.276,6.747-128.839,24.62-184.565,35.864c-27.752,5.599-47.704,29.986-47.704,58.297v76.946
                C196.442,308.335,256.202,368.094,329.919,368.094z" />
                                            <path d="M526.859,533.021c-10.345,0-20.121,2.418-28.812,6.703c-7.723,3.809-14.576,9.102-20.201,15.506
                c-9.95,11.325-16.036,26.118-16.204,42.337c-0.002,0.229-0.017,0.455-0.017,0.685v24.418v17.234v15.505v15.506v187.122
                c0,12.154,9.853,22.006,22.005,22.006h334.086h103.396c12.153,0,22.006-9.852,22.006-22.006V598.252
                c0-31.565-22.422-57.893-52.209-63.928c-4.207-0.852-8.562-1.303-13.021-1.303H549.414H526.859L526.859,533.021z" />
                                            <path d="M702.375,497.769c80.854,0,146.4-65.546,146.4-146.4v-84.396c0-31.052-21.886-57.8-52.322-63.941
                c-61.123-12.332-159.355-31.935-202.434-39.336c-1.879-0.323-3.743-0.478-5.577-0.478c-17.574,0-32.468,14.276-32.468,32.542
                v155.609C555.975,432.223,621.52,497.769,702.375,497.769z" />
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            Interviews</a></li>
                    <li><a href="?option=JobPosts">
                            <svg fill="white" width="30px" height="30px" viewBox="0 0 24 24" id="job"
                                data-name="Flat Color" xmlns="http://www.w3.org/2000/svg" class="icon flat-color">
                                <path id="secondary"
                                    d="M16,8H8A1,1,0,0,1,7,7V4A2,2,0,0,1,9,2h6a2,2,0,0,1,2,2V7A1,1,0,0,1,16,8ZM9,6h6V4H9Z"
                                    style="fill: rgb(44, 169, 188)"></path>
                                <rect id="primary" x="2" y="6" width="20" height="16" rx="2"
                                    style="fill: rgb(255, 255, 255)"></rect>
                                <path id="secondary-2" data-name="secondary"
                                    d="M15,14a1,1,0,0,1-1-1V12H7a1,1,0,0,1,0-2H17a1,1,0,0,1,0,2H16v1A1,1,0,0,1,15,14Z"
                                    style="fill: rgb(44, 169, 188)"></path>
                            </svg>

                            JobPosts</a></li>
                    <li><a href="?option=Skills">
                            <svg fill="white" width="30px" height="30px" viewBox="0 0 100 100"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M43.84,46.76a5.35,5.35,0,1,1,5.46-5.34A5.41,5.41,0,0,1,43.84,46.76Z"
                                    fill-rule="evenodd" />
                                <path
                                    d="M77.33,55.7,70.06,44.9V44A24,24,0,0,0,46.19,20a22,22,0,0,0-5.67.7A23.89,23.89,0,0,0,22.31,44a21.92,21.92,0,0,0,3.58,12.7c4.18,6,7,10.8,5.27,17.3a4.58,4.58,0,0,0,.9,4.2A4.43,4.43,0,0,0,35.74,80h19.6A4.72,4.72,0,0,0,60,76.2a5,5,0,0,0,.2-1.2,2.37,2.37,0,0,1,2.39-2H64a4.72,4.72,0,0,0,4.68-3.4A41.31,41.31,0,0,0,70.16,60h5.17a2.78,2.78,0,0,0,2.19-1.6A2.86,2.86,0,0,0,77.33,55.7ZM57.49,47.33l-1,1.57a2.22,2.22,0,0,1-1.76.94,2.38,2.38,0,0,1-.72-.16l-2.65-1a11.64,11.64,0,0,1-3.85,2.2l-.48,2.91a2,2,0,0,1-2,1.65h-2a2,2,0,0,1-2-1.65l-.48-2.91a10,10,0,0,1-3.69-2l-2.81,1a2.38,2.38,0,0,1-.72.16,2.1,2.1,0,0,1-1.76-1l-1-1.65a1.94,1.94,0,0,1,.48-2.51l2.33-1.89a10.11,10.11,0,0,1-.24-2.12,9.41,9.41,0,0,1,.24-2L31.1,36.88a1.92,1.92,0,0,1-.48-2.51l1-1.65a2,2,0,0,1,1.76-1,2.38,2.38,0,0,1,.72.16l2.81,1a11.52,11.52,0,0,1,3.69-2.12L41,28a1.91,1.91,0,0,1,2-1.57h2a1.92,1.92,0,0,1,2,1.49l.48,2.83a11.31,11.31,0,0,1,3.69,2l2.81-1a2.38,2.38,0,0,1,.72-.16,2.1,2.1,0,0,1,1.76,1l1,1.65A2,2,0,0,1,57,36.8l-2.33,1.89a9.56,9.56,0,0,1,.24,2.12,9.41,9.41,0,0,1-.24,2L57,44.74A2,2,0,0,1,57.49,47.33Z"
                                    fill-rule="evenodd" />
                            </svg>

                            Skills</a></li>
                </ul>
            </div>
            <div class="dash-right">
                <?php echo renderContent($selectedOption); ?>
            </div>
        </div>
    </div>
</body>

</html>