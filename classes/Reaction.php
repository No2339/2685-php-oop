<?php
 
 class Reaction extends Model {
    const TABLE='pst_reactions';

    // Reactions to posts
    static function reactions_top($limit = null)
    {
     
$qry = "SELECT pst_users.name, pst_posts.title, pst_reaction_types.type, COUNT(pst_reactions.id) AS total_reactions
FROM pst_reactions
JOIN pst_posts ON pst_reactions.post_id = pst_posts.id
JOIN pst_reaction_types ON pst_reactions.reaction_type_id = pst_reaction_types.id
join pst_users on  pst_users.id = pst_reaction_types.id
GROUP BY pst_posts.title, pst_reaction_types.type
ORDER BY total_reactions DESC";
    

    if ($limit) {
        $qry .= " Limit $limit";
    }
        $res = Model::$db->query($qry);
    
        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

 }
