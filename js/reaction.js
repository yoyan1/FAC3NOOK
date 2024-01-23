
const like = document.querySelectorAll("#like");

    like.forEach((reaction) => {
    reaction.addEventListener('mouseover', function() {
        const reactionContent = reaction.querySelector('.reaction_list');
        reactionContent.style.display = 'block';
    });

    reaction.addEventListener('mouseout', function() {
        const reactionContent = reaction.querySelector('.reaction_list');
        reactionContent.style.display = 'none';
    });

    reaction.querySelector('.reaction_list').addEventListener('mouseover', function() {
        this.style.display = 'block';
    });

    reaction.querySelector('.reaction_list').addEventListener('mouseout', function() {
        this.style.display = 'none';
    });
});

