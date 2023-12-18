
const like = document.getElementById("like");

    like.forEach((reaction) => {
        reaction.addEventListener('mouseover', function() {
            var userID = this.getAttribute('data-userid');
            document.getElementById("forId").value = userID;
            const reactionContent = reaction.querySelector('.reaction_list');
            reactionContent.style.display = 'block';
        });

        reaction.addEventListener('mouseout', function() {
            const reactionContent = reaction.querySelector('.reaction_list');
            reactionContent.style.display = 'none';
        });

        reaction.querySelector('.reaction_list').addEventListener('mouseover', function() {
            var userID = this.getAttribute('data-userid');
            document.getElementById("forId").value = userID;
            this.style.display = 'block';
        });

        reaction.querySelector('.reaction_list').addEventListener('mouseout', function() {
            this.style.display = 'none';
        });
    });

    document.ge