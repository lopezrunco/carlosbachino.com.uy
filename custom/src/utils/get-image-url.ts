export const getImageUrl = async (post: any): Promise<string> => {
  try {
    // Check if the post has a featured media link.
    if (
      post._links["wp:featuredmedia"] &&
      post._links["wp:featuredmedia"].length > 0
    ) {
      const mediaLink: string = post._links["wp:featuredmedia"][0].href;

      // Fetch media deatils.
      const response: Response = await fetch(mediaLink);
      if (response.ok) {
        const mediaData: any = await response.json();
        // Check if the media contains a full sized img.
        if (
          mediaData.media_details &&
          mediaData.media_details.sizes &&
          mediaData.media_details.sizes.full
        ) {
          return mediaData.media_details.sizes.full.source_url;
        }
      }
      throw new Error("Could not found media details.");
    } else {
      return "";
    }
  } catch (error) {
    console.error("Error fetching media details: ", error);
    return "";
  }
};
