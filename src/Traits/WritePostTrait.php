<?php namespace BishopJ88\LaraGab\Traits;

use Exception;

Trait WritePostTrait {
	/**
	 * Formatting method to make cURL work with Gab's interface.
	 *
	 * @param array $parameters [] This will be the parameters passed by
	 *      the methods preceding it.
	 *
	 * @return string Returns a formatted string that curl can work with.
	 */
    public function formatPost( $parameters = [] )
    {
        $allowed = [
        'media_attachments[]', 'gif', 'body', 'reply_to', 'is_quote',
        'nsfw', 'premium_min_tier', 'group', 'topic', 'poll',
        'poll_option_1', 'poll_option_2', 'poll_option_3', 'poll_option_4',
        'file'
        ];
        $formattedPost = [];
        
        array_push( $formattedPost, "------WebKitFormBoundary7MA4YWxkTrZu0gW\r\n");
        
        foreach( $parameters as $parameter_key => $parameter_value ){
            if( in_array($parameter_key, $allowed) ){
                if( $parameter_key == "file" ){
                    $type = pathinfo($parameter_value, PATHINFO_EXTENSION);
                    $data = file_get_contents($parameter_value);
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    
                    $parameter_value = $base64;
                }
				
				if( $parameter_key == "media_attachments[]" && is_array($parameter_value) ){
					foreach( $parameter_value as $attachment ){
						array_push( $formattedPost, "Content-Disposition: form-data;name=\"{$parameter_key}\"\r\n\r\n{$attachment->id}\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;");
					}
				} else {
					array_push( $formattedPost, "Content-Disposition: form-data;name=\"{$parameter_key}\"\r\n\r\n{$parameter_value}\r\n------WebKitFormBoundary7MA4YWxkTrZu0gW\r\nContent-Disposition: form-data;");	
				}
            }
        }
        array_push( $formattedPost, '--');
          
        return implode($formattedPost);
    }
	/**
	 * Creates a post.
	 *
	 * @param array $parameters ['body' => 'My first post!']
	 *
	 * The 'body' parameter is required.
	 *
	 * Other parameters that can be used:
	 *      media_attachments[]     Media attachment ID created using Create Media Attachment endpoint.
	 *                              You can send up to 4 attachments with a post.
	 *      gif                     Giphy gif ID
	 *      reply_to                ID of the post if you want to create this post as a reply. For quotes,
	 *                              use this column to pass the quoted post ID. But send is_quote
	 *                              with a value of 1.
	 *      is_quote                1 if you want to create this post as a quote. Don't forget to send
	 *                              the quoted post ID in reply_to parameter.
	 *      nsfw                    0 or 1 to mark this post Not Safe For Work. Remember, it is against
	 *                              community guidelines to post a NSFW content without the flag.
	 *                              So, remind that to your app's users.
	 *      premium_min_tier        Used to mark a post premium. Minimum amount of monthly subscription
	 *                              amount In cents. So if you want subscribers paying more tha $1.50 each
	 *                              month, you should send 150 in this parameter.
	 *      group                   If you want to send the post to a group, send group id in this parameter.
	 *      topic                   If you want to send the post to a topic, send topic id in this parameter.
	 *      poll                    0 or 1 to add a poll. If this parameter is 1, poll_option_1 and
	 *                              poll_option_2 columns are required.
	 *      poll_option_1           1st poll option. Required if poll is 1
	 *      poll_option_2           2nd poll option. Required if poll is 1
	 *      poll_option_3           3rd poll option. Optional even when poll is 1
	 *      poll_option_4           4th poll option. Optional even when poll is 1
	 *
	 * @return string Returns JSON of post or error message.
	 */
	public function createPost( $parameters = [] )
	{
        $parameters = $this->formatPost($parameters);

		return $this->post('https://api.gab.com/v1.0/posts', $parameters );
    }
	/**
	 * Creates a media attachment with given image.
	 *
	 * @param array $parameters ['file' => 'File URL']
	 *
	 * The 'file' parameter is required. Example:
	 * createMediaAttachment(['file' => public_path() . '/image.jpg']);
	 *
	 * The image to upload. Might be jpeg, png or gif. Animated gifs are allowed.
	 * Might not be more than 4mb.
	 *
	 * @return string Returns JSON of post or error message.
	 */
	public function createMediaAttachment( $parameters = [] )
	{
        $parameters = $this->formatPost($parameters);
        return $this->post('https://api.gab.com/v1.0/media-attachments/images', $parameters);
    }
	
}