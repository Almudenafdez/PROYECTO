document.addEventListener("DOMContentLoaded", () => {
    const designId = document.body.getAttribute("data-design-id");
    const likeBtn = document.getElementById("likeBtn");
    const likeCount = document.getElementById("likeCount");
    const commentInput = document.getElementById("commentInput");
    const commentList = document.getElementById("commentList");
    const addCommentBtn = document.getElementById("addComment");

    const likesKey = `likes_${designId}`;
    const likedKey = `liked_${designId}`;
    const commentsKey = `comments_${designId}`;

    let likes = parseInt(localStorage.getItem(likesKey)) || 0;
    let liked = localStorage.getItem(likedKey) === "true";

    likeCount.textContent = likes;
    updateLikeButton();

    likeBtn.addEventListener("click", () => {
        liked = !liked;
        likes = liked ? likes + 1 : likes - 1;
        localStorage.setItem(likesKey, likes);
        localStorage.setItem(likedKey, liked);
        likeCount.textContent = likes;
        updateLikeButton();
    });

    function updateLikeButton() {
        likeBtn.textContent = liked ? "Quitar Me Gusta" : "Me Gusta";
    }

    // --- COMENTARIOS ---
    let comments = JSON.parse(localStorage.getItem(commentsKey)) || [];

    const renderComments = () => {
        commentList.innerHTML = "";
        comments.forEach((comment, index) => {
            const li = document.createElement("li");
            li.innerHTML = `
                <span>${comment}</span>
                <button class="delete-comment" data-index="${index}">Eliminar</button>
            `;
            commentList.appendChild(li);
        });

        document.querySelectorAll(".delete-comment").forEach(btn => {
            btn.addEventListener("click", (e) => {
                const index = e.target.getAttribute("data-index");
                comments.splice(index, 1);
                localStorage.setItem(commentsKey, JSON.stringify(comments));
                renderComments();
            });
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