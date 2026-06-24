<?php
session_start();

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("Location: login.php");
    exit;
} 

include("backend/model.php");
$user_id = $_SESSION['user_id'];
$viewnotes = getNotes($user_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Notes App</title>
    <style>
        /* Pure Black, Zero-Distraction Theme */
        body {
            background-color: #000000;
            color: #FAFAFA;
            font-family: system-ui, -apple-system, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top Navigation Bar */
        .navbar {
            background-color: #000000;
            border-bottom: 1px solid #222;
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar h1 {
            margin: 0;
            font-size: 1.5rem;
            color: #FAFAFA;
            font-weight: 600;
        }
        .user-controls {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        /* Main Canvas Layout */
        .app-container {
            width: 90%;
            max-width: 800px; /* Constrains the entire app to a readable central column */
            margin: 2rem auto;
            display: flex;
            flex-direction: column;
            gap: 4rem; 
            flex-grow: 1; 
        }

        /* --- THE LIST: Displayed First --- */
        .notes-list {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        /* Individual Note Item (List Style) */
        .note-item {
            padding: 2rem 0; /* Creates vertical breathing room */
            border-bottom: 1px solid #333; /* Acts as the line separator */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        
        /* Remove the border from the very last note so it looks clean */
        .note-item:last-child {
            border-bottom: none;
        }

        .note-content {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            white-space: pre-wrap; 
            word-wrap: break-word;
            color: #e0e0e0;
        }
        
        .note-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .timestamp {
            color: #666;
            font-size: 0.85rem;
        }
        .btn-delete {
            color: #ff4444;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .btn-delete:hover {
            text-decoration: underline;
        }

        /* --- Add Note Section: Displayed Last --- */
        .editor-section {
            width: 100%;
            margin: 0 auto 3rem auto;
            border-top: 1px solid #222; /* Separates the editor from the list */
            padding-top: 2rem;
        }
        .editor-section form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        textarea {
            width: 100%;
            box-sizing: border-box;
            background-color: #0a0a0a;
            color: #FAFAFA;
            border: 1px solid #333;
            border-radius: 6px;
            padding: 1.2rem;
            font-size: 1rem;
            resize: vertical;
            min-height: 120px;
            font-family: inherit;
        }
        textarea:focus {
            outline: none;
            border-color: #666;
            background-color: #111;
        }
        
        /* Buttons */
        button {
            background-color: #FAFAFA;
            color: #000000;
            border: none;
            padding: 0.85rem 2rem;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease;
            align-self: flex-end;
        }
        button:hover {
            background-color: #cccccc;
        }
        .btn-logout {
            color: #ff4444;
            text-decoration: none;
            font-weight: 500;
        }
        .btn-logout:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<nav class="navbar">
    <h1>Notes App</h1>
    <div class="user-controls">
        <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
        <a href="/backend/auth/logout.php" class="btn-logout">Logout</a> 
    </div>
</nav>

<div class="app-container">

    <section class="notes-list">
        <?php while ($row = mysqli_fetch_assoc($viewnotes)) : ?>
            <div class="note-item">
                <div class="note-content">
                    <?php echo htmlspecialchars($row['note']); ?>
                </div>
                
                <div class="note-footer">
                    <span class="timestamp">
                        <?php echo date('M j, Y', strtotime($row['timestamp'])); ?>
                    </span>
                    <a href="/backend/deletenote.php?note_id=<?php echo $row['note_id']; ?>" class="btn-delete">Delete</a>
                </div>
            </div>
        <?php endwhile; ?>
    </section>

    <section class="editor-section">
        <form action="/backend/addnote.php" method="POST">
            <textarea name="note" placeholder="Take a note..." required></textarea>
            <button type="submit">Save Note</button>
        </form>
    </section>

</div>

</body>
</html>