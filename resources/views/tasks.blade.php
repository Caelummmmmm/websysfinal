<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>My Tasks</title>
        <style>
            :root {
                --bg: #f8f5ff;
                --panel: rgba(255, 255, 255, 0.8);
                --panel-solid: #ffffff;
                --line: #e9ddff;
                --text: #241b37;
                --muted: #695d8b;
                --pink: #ff8ab5;
                --pink-dark: #ee6ea8;
                --lavender: #d9c9ff;
                --mint: #dffaf2;
                --mint-text: #1d7d67;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                background:
                    radial-gradient(circle at top left, rgba(255, 184, 210, 0.35), transparent 28%),
                    radial-gradient(circle at bottom right, rgba(144, 197, 255, 0.25), transparent 30%),
                    var(--bg);
                font-family: Arial, sans-serif;
                color: var(--text);
            }

            .page {
                width: 100%;
                min-height: 100vh;
                padding: 32px 20px 48px;
            }

            .form-wrap {
                max-width: 1180px;
                margin: 0 auto;
            }

            .task-panel {
                background: var(--panel);
                backdrop-filter: blur(8px);
                border: 1px solid var(--line);
                border-radius: 24px;
                padding: 28px 30px;
                box-shadow: 0 18px 36px rgba(149, 126, 196, 0.12);
            }

            .divider {
                border-top: 1px solid var(--line);
                margin-top: 8px;
                padding-top: 24px;
            }

            h2 {
                margin: 0 0 18px;
                font-size: 34px;
                font-weight: 800;
                letter-spacing: -0.04em;
                color: var(--text);
            }

            label {
                display: block;
                font-size: 18px;
                font-weight: 700;
                margin-bottom: 9px;
                color: var(--text);
            }

            input, textarea {
                width: 100%;
                box-sizing: border-box;
                border: 1.5px solid #d9d0ef;
                background: rgba(255, 255, 255, 0.9);
                padding: 12px 14px;
                font-size: 18px;
                color: var(--text);
                border-radius: 14px;
                outline: none;
                transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
            }

            input:focus, textarea:focus {
                border-color: var(--pink);
                box-shadow: 0 0 0 4px rgba(255, 138, 181, 0.18);
            }

            input {
                height: 48px;
            }

            textarea {
                min-height: 146px;
                resize: vertical;
            }

            .field {
                margin-bottom: 22px;
            }

            .btn-wrap {
                display: flex;
                justify-content: flex-end;
                margin-top: 10px;
            }

            button {
                background: linear-gradient(135deg, var(--pink), var(--pink-dark));
                color: #fff;
                border: none;
                padding: 12px 26px;
                font-size: 18px;
                font-weight: 700;
                cursor: pointer;
                border-radius: 999px;
                box-shadow: 0 10px 18px rgba(238, 110, 168, 0.28);
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            button:hover {
                transform: translateY(-1px);
                box-shadow: 0 12px 20px rgba(238, 110, 168, 0.32);
            }

            .saved-title {
                margin-top: 42px;
                font-size: 32px;
                font-weight: 800;
                letter-spacing: -0.04em;
                color: var(--text);
            }

            .task-list {
                margin-top: 18px;
                display: grid;
                gap: 14px;
            }

            .task-item {
                border: 1px solid var(--line);
                background: rgba(255, 255, 255, 0.72);
                border-radius: 18px;
                padding: 18px 18px 16px;
                box-shadow: 0 8px 18px rgba(97, 80, 138, 0.06);
            }

            .task-item h3 {
                margin: 0 0 8px;
                font-size: 20px;
                color: var(--text);
            }

            .task-item p {
                margin: 0;
                font-size: 16px;
                color: var(--muted);
                line-height: 1.5;
            }

            @media (max-width: 640px) {
                .task-panel {
                    padding: 22px 18px;
                }

                h2, .saved-title {
                    font-size: 28px;
                }
            }
        </style>
    </head>
    <body>
        <div class="page">
            <div class="form-wrap">
                <div class="task-panel">
                    <div class="divider">
                        <h2>Add Task</h2>

                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf

                            <div class="field">
                                <label for="task_title">Task title</label>
                                <input id="task_title" name="task_title" type="text" value="{{ old('task_title') }}" placeholder="Enter task title">
                                @error('task_title')
                                    <div style="color: #b91c1c; margin-top: 8px; font-size: 14px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="field">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" placeholder="Add details...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div style="color: #b91c1c; margin-top: 8px; font-size: 14px;">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="btn-wrap">
                                <button type="submit">Add Task</button>
                            </div>
                        </form>
                    </div>

                    <div class="saved-title">Saved Tasks</div>

                    <div class="task-list">
                        @forelse ($tasks as $task)
                            <div class="task-item">
                                <h3>{{ $task->task_title }}</h3>
                                <p>{{ $task->description ?: 'No description provided.' }}</p>
                            </div>
                        @empty
                            <div class="task-item">
                                <p>No tasks have been added yet.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
