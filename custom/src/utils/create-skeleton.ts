export function createSkeleton() {
    const skeletonContainer = document.getElementById("skeleton");
    const numSkeletons = 3;
  
    const createSkeletonItem = () => {
      const skeletonCol = document.createElement("div");
      skeletonCol.classList.add("col-lg-4");
  
      const skeleton = document.createElement("div");
      skeleton.classList.add("skeleton");
  
      const skeletonImage = document.createElement("div");
      skeletonImage.classList.add("skeleton-image", "animated-background");
  
      const skeletonText1 = document.createElement("div");
      skeletonText1.classList.add("skeleton-text", "animated-background");
  
      const skeletonText2 = document.createElement("div");
      skeletonText2.classList.add("skeleton-text", "animated-background");
      skeletonText2.style.width = "80%";
  
      const skeletonText3 = document.createElement("div");
      skeletonText3.classList.add("skeleton-text", "animated-background");
      skeletonText3.style.width = "60%";
  
      const skeletonText4 = document.createElement("div");
      skeletonText4.classList.add("skeleton-text", "animated-background");
      skeletonText4.style.width = "40%";
  
      skeleton.appendChild(skeletonImage);
      skeleton.appendChild(skeletonText1);
      skeleton.appendChild(skeletonText2);
      skeleton.appendChild(skeletonText3);
      skeleton.appendChild(skeletonText4);
  
      skeletonCol.appendChild(skeleton);
  
      return skeletonCol;
    };
  
    const skeletonRow = document.createElement("div");
    skeletonRow.classList.add("row");
  
    for (let i = 0; i < numSkeletons; i++) {
      const skeletonItem = createSkeletonItem();
      skeletonRow.appendChild(skeletonItem);
    }
  
    const skeletonContainerDiv = document.createElement("div");
    skeletonContainerDiv.classList.add("container");
    skeletonContainerDiv.appendChild(skeletonRow);
  
    if (skeletonContainer) {
      skeletonContainer.appendChild(skeletonContainerDiv);
    } else {
      console.error("No skeleton container found.");
    }
  }
  