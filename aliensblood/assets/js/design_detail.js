document.addEventListener("DOMContentLoaded", () => {
    const designId = document.body.getAttribute("data-design-id"); // ← importante: design_detail.php debe tener esto
    const likeBtn = document.getElementById("likeBtn");
    const likeCount = document.getElementById("likeCount");
    const commentInput = document.getElementById("commentInput");
    const commentList = document.getElementById("commentList");
    const addCommentBtn = document.getElementById("addComment");

    // --- LIKES ---
    const likesKey = `likes_${designId}`;
    let likes = parseInt(localStorage.getItem(likesKey)) || 0;
    likeCount.textContent = likes;

    // Check if already liked
    const likedKey = `liked_${designId}`;
    if (localStorage.getItem(likedKey)) {
        likeBtn.disabled = true;
        likeBtn.textContent = "Ya te gusta";
    }

    likeBtn.addEventListener("click", () => {
        likes += 1;
        localStorage.setItem(likesKey, likes);
        localStorage.setItem(likedKey, "true");
        likeCount.textContent = likes;
        likeBtn.disabled = true;
        likeBtn.textContent = "Ya te gusta";
    });

    // --- COMENTARIOS ---
    const commentsKey = `comments_${designId}`;
    let comments = JSON.parse(localStorage.getItem(commentsKey)) || [];

    const renderComments = () => {
        commentList.innerHTML = "";
        comments.forEach(comment => {
            const li = document.createElement("li");
            li.textContent = comment;
            commentList.appendChild(li);
        });
    };

    renderComments();

    addCommentBtn.addEventListener("click", () => {
        const newComment = commentInput.value.trim();
        if (newComment !== "") {
            comments.push(newComment);
            localStorage.setItem(commentsKey, JSON.stringify(comments));
            commentInput.value = "";
            renderComments();
        }
    });
});
